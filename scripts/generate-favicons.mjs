/**
 * Build square favicons from public/images/logo.png (transparent canvas, no black bars).
 * Run: node scripts/generate-favicons.mjs
 */
import { copyFileSync } from 'node:fs';
import sharp from 'sharp';

const source = 'public/images/logo.png';
const sizes = [48, 96, 180, 192, 512];
const padRatio = 0.08;

for (const size of sizes) {
  const pad = Math.max(2, Math.round(size * padRatio));
  const inner = size - pad * 2;
  const buffer = await sharp(source)
    .resize(inner, inner, { fit: 'inside', withoutEnlargement: false })
    .extend({
      top: pad,
      bottom: pad,
      left: pad,
      right: pad,
      background: { r: 0, g: 0, b: 0, alpha: 0 },
    })
    .png()
    .toBuffer();

  await sharp(buffer)
    .resize(size, size, { fit: 'contain', background: { r: 0, g: 0, b: 0, alpha: 0 } })
    .png()
    .toFile(`public/images/favicon-${size}.png`);
}

copyFileSync('public/images/favicon-48.png', 'public/favicon.ico');
console.log('Favicons written:', sizes.map((s) => `favicon-${s}.png`).join(', '), '+ favicon.ico');
