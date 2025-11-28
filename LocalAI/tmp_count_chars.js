const fs = require('fs');
const path = process.argv[2];
if (!path) { console.error('Usage: node tmp_count_chars.js <file>'); process.exit(2); }
const s = fs.readFileSync(path,'utf8');
const counts = { '{':0, '}':0, '(':0, ')':0, '[':0, ']':0 };
for(const ch of s){ if(counts.hasOwnProperty(ch)) counts[ch]++; }
console.log(counts);
