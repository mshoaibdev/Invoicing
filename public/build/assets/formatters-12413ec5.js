const e=r=>r?r.split(" ").map(t=>t.charAt(0).toUpperCase()).join(""):"",n=(r,a="USD")=>parseFloat(r).toLocaleString(a,{style:"currency",currency:a,currencyDisplay:"narrowSymbol",useGrouping:!0});export{e as a,n as f};
