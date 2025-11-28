const fs = require('fs');
const path = process.argv[2];
if (!path) { console.error('Usage: node tmp_unmatched_braces.js <file>'); process.exit(2); }
const s = fs.readFileSync(path,'utf8');
const lines = s.split('\n');
const stack = [];
for(let i=0;i<lines.length;i++){
  const L = lines[i];
  for(let j=0;j<L.length;j++){
    const ch = L[j];
    if (ch === '{') stack.push({line:i+1, col:j+1, ctx: L.trim()});
    else if (ch === '}') stack.pop();
  }
}
if (!stack.length) { console.log('No unmatched opening braces.'); process.exit(0); }
console.log('Unmatched opening braces (most recent last):');
stack.forEach(function(it){ console.log('line', it.line, 'col', it.col, 'ctx:', it.ctx); });
console.log('Total unmatched:', stack.length);
