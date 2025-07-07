
const fs = require("fs-extra");
const path = require("path");
const contentful = require("contentful");

const client = contentful.createClient({
  space: "p7npvw0haegu",
  accessToken: "VCkXUeBUS3eYJEd_MQkGKZXpUYBiG6GlkP3NW4P65uY",
});

const POSTS_DIR = path.join(__dirname, "posts");
const DATA_DIR = path.join(__dirname, "data");

async function fetchAndSaveJSON(contentType, fileName, mapFn) {
  const response = await client.getEntries({ content_type: contentType });
  const entries = response.items.map(mapFn);
  const filePath = path.join(DATA_DIR, `${fileName}.json`);
  await fs.ensureDir(DATA_DIR);
  await fs.writeJson(filePath, entries, { spaces: 2 });
  console.log(`✅ Saved ${fileName}.json (${entries.length} items)`);
}

async function fetchArticles() {
  const response = await client.getEntries({ content_type: "article" });

  for (const entry of response.items) {
    const { title, description, seoPageTitle, seoSlug, seoDescription, cover } = entry.fields;
    const author = entry.fields.author?.fields;
    const category = entry.fields.category?.fields;
    const tags = entry.fields.tags?.map(tag => tag.fields.name);

    const markdown = `---
title: "${title}"
description: "${description || ''}"
author: "${author?.name || ''}"
author_function: "${author?.function || ''}"
author_photo: "${author?.photo?.fields?.file?.url || ''}"
category: "${category?.title || ''}"
tags: ${JSON.stringify(tags || [])}
seo:
  title: "${seoPageTitle || ''}"
  slug: "${seoSlug || ''}"
  description: "${seoDescription || ''}"
cover: "${cover?.fields?.file?.url || ''}"
---

${description || ''}
`;

    const fileName = `${seoSlug || title.replace(/\s+/g, "-").toLowerCase()}.md`;
    await fs.ensureDir(POSTS_DIR);
    await fs.writeFile(path.join(POSTS_DIR, fileName), markdown, "utf8");
    console.log(`📄 Artikel opgeslagen: ${fileName}`);
  }
}

async function main() {
  try {
    await fetchArticles();

    await fetchAndSaveJSON("author", "authors", (item) => ({
      name: item.fields.name,
      function: item.fields.function,
      photo: item.fields.photo?.fields?.file?.url || null,
    }));

    await fetchAndSaveJSON("category", "categories", (item) => ({
      title: item.fields.title,
      url: item.fields.url,
    }));

    await fetchAndSaveJSON("tags", "tags", (item) => ({
      name: item.fields.name,
      url: item.fields.url,
    }));

    console.log("✅ Alles is succesvol opgehaald en opgeslagen.");
  } catch (err) {
    console.error("❌ Fout bij ophalen of opslaan:", err);
  }
}

main();
