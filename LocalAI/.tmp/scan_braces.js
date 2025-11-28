const fs = require('fs');
const path = 'x:/Programacion/XlerionWeb/LocalAI/xlerion_cmr/public/js/templates-editor.js';
const s = fs.readFileSync(path,'utf8');
const lines = s.split(/\r?\n/);
let lineNo = 1;
let i = 0;
let state = 'normal';
let stack = [];
let lastSnapshot = null;
let targets = [1043];
for (let idx = 0; idx < s.length; idx++){
  const ch = s[idx];
  const ch2 = s.slice(idx, idx+2);
  if (ch === '\n') lineNo++;
  if (state === 'normal'){
    if (ch2 === '//') { state='line'; idx++; continue; }
    if (ch2 === '/*') { state='block'; idx++; continue; }
    if (ch === '"' || ch === "'" || ch === '`'){
      const q = ch; idx++; while(idx<s.length){ if(s[idx] === '\\'){ idx+=2; continue } if(s[idx] === q){ break } idx++; } continue;
    }
    if (ch === '(' || ch === '[' || ch === '{') stack.push({ch:ch,pos:idx,line:lineNo});
    else if (ch === ')' || ch === ']' || ch === '}'){
      const last = stack[stack.length-1];
      if (last && ((last.ch==='(' && ch===')') || (last.ch==='[' && ch===']') || (last.ch==='{' && ch==='}'))){ stack.pop(); }
      else { console.log('UNMATCHED CLOSING', ch, 'at', lineNo); }
    }
  } else if (state==='line'){
    if (ch === '\n') state='normal';
  } else if (state==='block'){
    if (ch2 === '*/'){ state='normal'; idx++; }
  }
  if (targets.includes(lineNo) && lastSnapshot === null){ lastSnapshot = {line: lineNo, pos: idx, stack: stack.slice()}; }
}
console.log('final stack length', stack.length);
if (lastSnapshot) {
  console.log('snapshot at line', lastSnapshot.line);
  lastSnapshot.stack.slice(-10).forEach((st, i)=>{
    console.log(i, st.line, st.ch, 'pos', st.pos);
  });
}
// show surrounding lines
const start = Math.max(0, 1043-10);
const end = Math.min(lines.length, 1043+10);
console.log('\n--- file context lines', start+1, 'to', end, '---');
for(let j=start;j<end;j++){
  console.log((j+1).toString().padStart(4,' ')+': '+lines[j]);
}
