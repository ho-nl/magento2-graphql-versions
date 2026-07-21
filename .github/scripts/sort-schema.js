// Normalize a GraphQL SDL file: parse, sort all types/fields/arguments/enum
// values lexicographically, and reprint with graphql-js. This keeps the
// committed schema.graphql diffable between Magento versions regardless of the
// order Magento emits definitions in.
const { buildSchema, lexicographicSortSchema, printSchema } = require('graphql');
const fs = require('fs');

const file = process.argv[2] || 'schema.graphql';
let sdl = fs.readFileSync(file, 'utf8');
// Old webonyx (Magento <= 2.3.3) prints implements lists comma-separated
// (pre-2018 SDL syntax); modern graphql-js only parses ampersands.
sdl = sdl.replace(
  /^((?:type|interface)\s+\S+\s+implements\s+)([^{&]+)(\{)/gm,
  (m, pre, list, brace) => pre + list.split(',').map(s => s.trim()).filter(Boolean).join(' & ') + ' ' + brace
);
const schema = lexicographicSortSchema(buildSchema(sdl, { assumeValidSDL: true }));
fs.writeFileSync(file, printSchema(schema) + '\n');
console.log(`sorted ${file}`);
