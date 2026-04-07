/**
 * Конвертация JPG → WebP для лендинга.
 *
 * Использование: node scripts/convert-webp.js
 * Зависимости: sharp (npx sharp-cli)
 */

const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const IMG_DIR = path.join(
  __dirname,
  '../wp-content/themes/ovklife/assets/images/landing',
);

async function convert() {
  const files = fs.readdirSync(IMG_DIR).filter((f) => f.endsWith('.jpg'));

  console.log(`Найдено ${files.length} JPG файлов для конвертации.`);

  let converted = 0;
  let skipped = 0;

  for (const file of files) {
    const input = path.join(IMG_DIR, file);
    const output = path.join(IMG_DIR, file.replace('.jpg', '.webp'));

    if (fs.existsSync(output)) {
      skipped++;
      continue;
    }

    try {
      await sharp(input).webp({ quality: 82 }).toFile(output);

      const origSize = fs.statSync(input).size;
      const webpSize = fs.statSync(output).size;
      const saving = Math.round((1 - webpSize / origSize) * 100);

      console.log(`  ${file} → .webp (${saving}% меньше)`);
      converted++;
    } catch (err) {
      console.error(`  ОШИБКА: ${file} — ${err.message}`);
    }
  }

  console.log(`\nГотово: ${converted} конвертировано, ${skipped} пропущено.`);
}

convert();
