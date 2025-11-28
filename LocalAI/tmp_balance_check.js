const fs = require('fs');
const path = process.argv[2];
if (!path) { console.error('Usage: node tmp_balance_check.js <file>'); process.exit(2); }
const s = fs.readFileSync(path,'utf8');
const lines = s.split('\n');
let b=0,p=0,br=0;
for(let i=0;i<lines.length;i++){
  const L = lines[i];
  for(let j=0;j<L.length;j++){
    const ch = L[j];
    if (ch==='{' ) b++;
    else if (ch==='}') b--;
  }
  if (i>1050 && i<1220) console.log('line', i+1, 'braces=', b, '->', L.trim());
}
console.log('FINAL counts: braces=',b,'parens=',p,'brackets=',br);
for(let i=Math.max(0,lines.length-40); i<lines.length;i++) console.log((i+1)+": "+lines[i]);
