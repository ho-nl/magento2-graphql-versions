// Normalize a GraphQL SDL file: parse, sort all types/fields/arguments/enum
// values lexicographically, and reprint with graphql-js. This keeps the
// committed schema.graphql diffable between Magento versions regardless of the
// order Magento emits definitions in.
const { buildSchema, lexicographicSortSchema, printSchema } = require('graphql');
const fs = require('fs');

const file = process.argv[2] || 'schema.graphql';
const sdl = fs.readFileSync(file, 'utf8');
const schema = lexicographicSortSchema(buildSchema(sdl, { assumeValidSDL: true }));
fs.writeFileSync(file, printSchema(schema) + '\n');
console.log(`sorted ${file}`);
