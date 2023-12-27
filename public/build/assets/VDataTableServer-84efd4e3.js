import{V as me,a as ae}from"./VCard-a375baf5.js";import{r as E,a as dt,f as ft,b as u,w as P,V,d as B,t as X,g as H,E as Be,u as Y,U as De,F as M,H as T,O as z,k as x,a8 as Fe,aM as $,aP as U,aH as ve,I as W,aq as Se,bc as gt,K,aK as j,a5 as ye,ax as Ie,bd as he,ay as k,be as pe,M as _e,bf as mt,aU as vt,aJ as bt,J as q,aV as yt,bg as ht,a6 as Ce,bh as Z,bi as pt,bj as St,av as Oe}from"./main-c40ee4ed.js";import{V as be}from"./VDialog-fe67dd57.js";import{b as xt,m as wt,V as le}from"./VTextarea-bfeb20e3.js";import{V as xe}from"./VCheckboxBtn-609a0dc2.js";const Pt=B("span",{class:"text-5xl"},"!",-1),kt={class:"text-lg font-weight-medium"},Tt={class:"text-3xl"},Vt={class:"text-h4 mb-4"},Dt=B("span",{class:"text-5xl font-weight-light"},"X",-1),It={class:"text-h4 mb-4"},ra={__name:"ConfirmDialog",props:{confirmationQuestion:{type:String,required:!0},isDialogVisible:{type:Boolean,required:!0},confirmTitle:{type:String,required:!0},confirmMsg:{type:String,required:!0},cancelTitle:{type:String,required:!0},cancelMsg:{type:String,required:!0}},emits:["update:isDialogVisible","confirm"],setup(e,{emit:l}){const a=e,t=E(!1),n=E(!1),d=o=>{l("update:isDialogVisible",o)},s=()=>{l("confirm",!0),d(!1),t.value=!0},c=()=>{l("confirm",!1),l("update:isDialogVisible",!1),n.value=!0};return(o,r)=>(dt(),ft(M,null,[u(be,{"max-width":"500","model-value":a.isDialogVisible,"onUpdate:modelValue":d},{default:P(()=>[u(me,{class:"text-center px-10 py-6"},{default:P(()=>[u(ae,null,{default:P(()=>[u(V,{icon:"",variant:"outlined",color:"warning",class:"my-4",style:{"block-size":"88px","inline-size":"88px","pointer-events":"none"}},{default:P(()=>[Pt]),_:1}),B("h6",kt,X(a.confirmationQuestion),1)]),_:1}),u(ae,{class:"d-flex align-center justify-center gap-2"},{default:P(()=>[u(V,{variant:"elevated",onClick:s},{default:P(()=>[H(" Confirm ")]),_:1}),u(V,{color:"secondary",variant:"tonal",onClick:c},{default:P(()=>[H(" Cancel ")]),_:1})]),_:1})]),_:1})]),_:1},8,["model-value"]),u(be,{modelValue:Y(t),"onUpdate:modelValue":r[1]||(r[1]=i=>De(t)?t.value=i:null),"max-width":"500"},{default:P(()=>[u(me,null,{default:P(()=>[u(ae,{class:"text-center px-10 py-6"},{default:P(()=>[u(V,{icon:"",variant:"outlined",color:"success",class:"my-4",style:{"block-size":"88px","inline-size":"88px","pointer-events":"none"}},{default:P(()=>[B("span",Tt,[u(Be,{icon:"tabler-check"})])]),_:1}),B("h1",Vt,X(a.confirmTitle),1),B("p",null,X(a.confirmMsg),1),u(V,{color:"success",onClick:r[0]||(r[0]=i=>t.value=!1)},{default:P(()=>[H(" Ok ")]),_:1})]),_:1})]),_:1})]),_:1},8,["modelValue"]),u(be,{modelValue:Y(n),"onUpdate:modelValue":r[3]||(r[3]=i=>De(n)?n.value=i:null),"max-width":"500"},{default:P(()=>[u(me,null,{default:P(()=>[u(ae,{class:"text-center px-10 py-6"},{default:P(()=>[u(V,{icon:"",variant:"outlined",color:"error",class:"my-4",style:{"block-size":"88px","inline-size":"88px","pointer-events":"none"}},{default:P(()=>[Dt]),_:1}),B("h1",It,X(a.cancelTitle),1),B("p",null,X(a.cancelMsg),1),u(V,{color:"success",onClick:r[2]||(r[2]=i=>n.value=!1)},{default:P(()=>[H(" Ok ")]),_:1})]),_:1})]),_:1})]),_:1},8,["modelValue"])],64))}};const Ae=T({page:{type:[Number,String],default:1},itemsPerPage:{type:[Number,String],default:10}},"DataTable-paginate"),Ee=Symbol.for("vuetify:data-table-pagination");function Me(e){const l=z(e,"page",void 0,t=>+(t??1)),a=z(e,"itemsPerPage",void 0,t=>+(t??10));return{page:l,itemsPerPage:a}}function $e(e){const{page:l,itemsPerPage:a,itemsLength:t}=e,n=x(()=>a.value===-1?0:a.value*(l.value-1)),d=x(()=>a.value===-1?t.value:Math.min(t.value,n.value+a.value)),s=x(()=>a.value===-1||t.value===0?1:Math.ceil(t.value/a.value));Fe(()=>{l.value>s.value&&(l.value=s.value)});function c(g){a.value=g,l.value=1}function o(){l.value=ve(l.value+1,1,s.value)}function r(){l.value=ve(l.value-1,1,s.value)}function i(g){l.value=ve(g,1,s.value)}const m={page:l,itemsPerPage:a,startIndex:n,stopIndex:d,pageCount:s,itemsLength:t,nextPage:o,prevPage:r,setPage:i,setItemsPerPage:c};return $(Ee,m),m}function _t(){const e=U(Ee);if(!e)throw new Error("Missing pagination!");return e}function Ct(e){const{items:l,startIndex:a,stopIndex:t,itemsPerPage:n}=e;return{paginatedItems:x(()=>n.value<=0?l.value:l.value.slice(a.value,t.value))}}const we=T({prevIcon:{type:String,default:"$prev"},nextIcon:{type:String,default:"$next"},firstIcon:{type:String,default:"$first"},lastIcon:{type:String,default:"$last"},itemsPerPageText:{type:String,default:"$vuetify.dataFooter.itemsPerPageText"},pageText:{type:String,default:"$vuetify.dataFooter.pageText"},firstPageLabel:{type:String,default:"$vuetify.dataFooter.firstPage"},prevPageLabel:{type:String,default:"$vuetify.dataFooter.prevPage"},nextPageLabel:{type:String,default:"$vuetify.dataFooter.nextPage"},lastPageLabel:{type:String,default:"$vuetify.dataFooter.lastPage"},itemsPerPageOptions:{type:Array,default:()=>[{value:10,title:"10"},{value:25,title:"25"},{value:50,title:"50"},{value:100,title:"100"},{value:-1,title:"$vuetify.dataFooter.itemsPerPageAll"}]},showCurrentPage:Boolean},"VDataTableFooter"),ne=W()({name:"VDataTableFooter",props:we(),setup(e,l){let{slots:a}=l;const{t}=Se(),{page:n,pageCount:d,startIndex:s,stopIndex:c,itemsLength:o,itemsPerPage:r,setItemsPerPage:i}=_t(),m=x(()=>e.itemsPerPageOptions.map(g=>({...g,title:t(g.title)})));return()=>{var g;return u("div",{class:"v-data-table-footer"},[(g=a.prepend)==null?void 0:g.call(a),u("div",{class:"v-data-table-footer__items-per-page"},[u("span",null,[t(e.itemsPerPageText)]),u(xt,{items:m.value,modelValue:r.value,"onUpdate:modelValue":y=>i(Number(y)),density:"compact",variant:"outlined","hide-details":!0},null)]),u("div",{class:"v-data-table-footer__info"},[u("div",null,[t(e.pageText,o.value?s.value+1:0,c.value,o.value)])]),u("div",{class:"v-data-table-footer__pagination"},[u(V,{icon:e.firstIcon,variant:"plain",onClick:()=>n.value=1,disabled:n.value===1,"aria-label":t(e.firstPageLabel)},null),u(V,{icon:e.prevIcon,variant:"plain",onClick:()=>n.value=Math.max(1,n.value-1),disabled:n.value===1,"aria-label":t(e.prevPageLabel)},null),e.showCurrentPage&&u("span",{key:"page",class:"v-data-table-footer__page"},[n.value]),u(V,{icon:e.nextIcon,variant:"plain",onClick:()=>n.value=Math.min(d.value,n.value+1),disabled:n.value===d.value,"aria-label":t(e.nextPageLabel)},null),u(V,{icon:e.lastIcon,variant:"plain",onClick:()=>n.value=d.value,disabled:n.value===d.value,"aria-label":t(e.lastPageLabel)},null)])])}}}),Pe=gt({align:{type:String,default:"start"},fixed:Boolean,fixedOffset:[Number,String],height:[Number,String],lastFixed:Boolean,noPadding:Boolean,tag:String,width:[Number,String]},(e,l)=>{let{slots:a,attrs:t}=l;const n=e.tag??"td";return u(n,K({class:["v-data-table__td",{"v-data-table-column--fixed":e.fixed,"v-data-table-column--last-fixed":e.lastFixed,"v-data-table-column--no-padding":e.noPadding},`v-data-table-column--align-${e.align}`],style:{height:j(e.height),width:j(e.width),left:j(e.fixedOffset||null)}},t),{default:()=>{var d;return[(d=a.default)==null?void 0:d.call(a)]}})}),Bt=T({headers:{type:Array,default:()=>[]}},"DataTable-header"),Ne=Symbol.for("vuetify:data-table-headers");function Le(e,l){const a=E([]),t=E([]);ye(()=>e.headers,()=>{var y,b,S;const d=e.headers.length?Array.isArray(e.headers[0])?e.headers:[e.headers]:[],s=d.flatMap((f,v)=>f.map(p=>({column:p,row:v}))),c=d.length,o={title:"",sortable:!1},r={...o,width:48};if((y=l==null?void 0:l.groupBy)!=null&&y.value.length){const f=s.findIndex(v=>{let{column:p}=v;return p.key==="data-table-group"});f<0?s.unshift({column:{...o,key:"data-table-group",title:"Group",rowspan:c},row:0}):s.splice(f,1,{column:{...o,...s[f].column},row:s[f].row})}if((b=l==null?void 0:l.showSelect)!=null&&b.value){const f=s.findIndex(v=>{let{column:p}=v;return p.key==="data-table-select"});f<0?s.unshift({column:{...r,key:"data-table-select",rowspan:c},row:0}):s.splice(f,1,{column:{...r,...s[f].column},row:s[f].row})}if((S=l==null?void 0:l.showExpand)!=null&&S.value){const f=s.findIndex(v=>{let{column:p}=v;return p.key==="data-table-expand"});f<0?s.push({column:{...r,key:"data-table-expand",rowspan:c},row:0}):s.splice(f,1,{column:{...r,...s[f].column},row:s[f].row})}const i=Ie(c).map(()=>[]),m=Ie(c).fill(0);s.forEach(f=>{let{column:v,row:p}=f;const _=v.key;for(let w=p;w<=p+(v.rowspan??1)-1;w++)i[w].push({...v,key:_,fixedOffset:m[w],sortable:v.sortable??!!v.key}),m[w]+=Number(v.width??0)}),i.forEach(f=>{for(let v=f.length;v--;v>=0)if(f[v].fixed){f[v].lastFixed=!0;return}});const g=new Set;a.value=i.map(f=>{const v=[];for(const p of f)g.has(p.key)||(g.add(p.key),v.push(p));return v}),t.value=i.at(-1)??[]},{deep:!0,immediate:!0});const n={headers:a,columns:t};return $(Ne,n),n}function ue(){const e=U(Ne);if(!e)throw new Error("Missing headers!");return e}const Ft={showSelectAll:!1,allSelected:()=>[],select:e=>{var t;let{items:l,value:a}=e;return new Set(a?[(t=l[0])==null?void 0:t.value]:[])},selectAll:e=>{let{selected:l}=e;return l}},Ge={showSelectAll:!0,allSelected:e=>{let{currentPage:l}=e;return l},select:e=>{let{items:l,value:a,selected:t}=e;for(const n of l)a?t.add(n.value):t.delete(n.value);return t},selectAll:e=>{let{value:l,currentPage:a,selected:t}=e;return Ge.select({items:a,value:l,selected:t})}},Re={showSelectAll:!0,allSelected:e=>{let{allItems:l}=e;return l},select:e=>{let{items:l,value:a,selected:t}=e;for(const n of l)a?t.add(n.value):t.delete(n.value);return t},selectAll:e=>{let{value:l,allItems:a,selected:t}=e;return Re.select({items:a,value:l,selected:t})}},Ot=T({showSelect:Boolean,selectStrategy:{type:[String,Object],default:"page"},modelValue:{type:Array,default:()=>[]}},"DataTable-select"),He=Symbol.for("vuetify:data-table-selection");function Ke(e,l){let{allItems:a,currentPage:t}=l;const n=z(e,"modelValue",e.modelValue,f=>new Set(f),f=>[...f.values()]),d=x(()=>a.value.filter(f=>f.selectable)),s=x(()=>t.value.filter(f=>f.selectable)),c=x(()=>{if(typeof e.selectStrategy=="object")return e.selectStrategy;switch(e.selectStrategy){case"single":return Ft;case"all":return Re;case"page":default:return Ge}});function o(f){return he(f).every(v=>n.value.has(v.value))}function r(f){return he(f).some(v=>n.value.has(v.value))}function i(f,v){const p=c.value.select({items:f,value:v,selected:new Set(n.value)});n.value=p}function m(f){i([f],!o([f]))}function g(f){const v=c.value.selectAll({value:f,allItems:d.value,currentPage:s.value,selected:new Set(n.value)});n.value=v}const y=x(()=>n.value.size>0),b=x(()=>{const f=c.value.allSelected({allItems:d.value,currentPage:s.value});return o(f)}),S={toggleSelect:m,select:i,selectAll:g,isSelected:o,isSomeSelected:r,someSelected:y,allSelected:b,showSelectAll:c.value.showSelectAll};return $(He,S),S}function se(){const e=U(He);if(!e)throw new Error("Missing selection!");return e}const At=T({sortBy:{type:Array,default:()=>[]},customKeySort:Object,multiSort:Boolean,mustSort:Boolean},"DataTable-sort"),je=Symbol.for("vuetify:data-table-sort");function ze(e){const l=z(e,"sortBy"),a=k(e,"mustSort"),t=k(e,"multiSort");return{sortBy:l,mustSort:a,multiSort:t}}function Ue(e){const{sortBy:l,mustSort:a,multiSort:t,page:n}=e,d=o=>{let r=l.value.map(m=>({...m}))??[];const i=r.find(m=>m.key===o.key);i?i.order==="desc"?a.value?i.order="asc":r=r.filter(m=>m.key!==o.key):i.order="desc":t.value?r=[...r,{key:o.key,order:"asc"}]:r=[{key:o.key,order:"asc"}],l.value=r,n&&(n.value=1)};function s(o){return!!l.value.find(r=>r.key===o.key)}const c={sortBy:l,toggleSort:d,isSorted:s};return $(je,c),c}function Et(){const e=U(je);if(!e)throw new Error("Missing sort!");return e}function Mt(e,l,a){const t=Se();return{sortedItems:x(()=>a.value.length?$t(l.value,a.value,t.current.value,e.customKeySort):l.value)}}function $t(e,l,a,t){const n=new Intl.Collator(a,{sensitivity:"accent",usage:"sort"});return[...e].sort((d,s)=>{for(let c=0;c<l.length;c++){const o=l[c].key,r=l[c].order??"asc";if(r===!1)continue;let i=pe(d.raw,o),m=pe(s.raw,o);if(r==="desc"&&([i,m]=[m,i]),t!=null&&t[o]){const g=t[o](i,m);if(!g)continue;return g}if(i instanceof Date&&m instanceof Date)return i.getTime()-m.getTime();if([i,m]=[i,m].map(g=>g!=null?g.toString().toLocaleLowerCase():g),i!==m)return!isNaN(i)&&!isNaN(m)?Number(i)-Number(m):n.compare(i,m)}return 0})}const We=T({color:String,sticky:Boolean,multiSort:Boolean,sortAscIcon:{type:_e,default:"$sortAsc"},sortDescIcon:{type:_e,default:"$sortDesc"},...mt()},"VDataTableHeaders"),re=W()({name:"VDataTableHeaders",props:We(),setup(e,l){let{slots:a,emit:t}=l;const{toggleSort:n,sortBy:d,isSorted:s}=Et(),{someSelected:c,allSelected:o,selectAll:r,showSelectAll:i}=se(),{columns:m,headers:g}=ue(),{loaderClasses:y}=vt(e),b=(w,h)=>{if(!(!e.sticky&&!w.fixed))return{position:"sticky",zIndex:w.fixed?4:e.sticky?3:void 0,left:w.fixed?j(w.fixedOffset):void 0,top:e.sticky?`calc(var(--v-table-header-height) * ${h})`:void 0}};function S(w){const h=d.value.find(C=>C.key===w.key);return h?h.order==="asc"?e.sortAscIcon:e.sortDescIcon:e.sortAscIcon}const{backgroundColorClasses:f,backgroundColorStyles:v}=bt(e,"color"),p=x(()=>({headers:g.value,columns:m.value,toggleSort:n,isSorted:s,sortBy:d.value,someSelected:c.value,allSelected:o.value,selectAll:r,getSortIcon:S,getFixedStyles:b})),_=w=>{let{column:h,x:C,y:F}=w;const Q=h.key==="data-table-select"||h.key==="data-table-expand";return u(Pe,{tag:"th",align:h.align,class:["v-data-table__th",{"v-data-table__th--sortable":h.sortable,"v-data-table__th--sorted":s(h)},y.value],style:{width:j(h.width),minWidth:j(h.width),...b(h,F)},colspan:h.colspan,rowspan:h.rowspan,onClick:h.sortable?()=>n(h):void 0,lastFixed:h.lastFixed,noPadding:Q},{default:()=>{var G;const N=`column.${h.key}`,L={column:h,selectAll:r,isSorted:s,toggleSort:n,sortBy:d.value,someSelected:c.value,allSelected:o.value,getSortIcon:S};return a[N]?a[N](L):h.key==="data-table-select"?((G=a["column.data-table-select"])==null?void 0:G.call(a,L))??(i&&u(xe,{modelValue:o.value,indeterminate:c.value&&!o.value,"onUpdate:modelValue":r},null)):u("div",{class:"v-data-table-header__content"},[u("span",null,[h.title]),h.sortable&&u(Be,{key:"icon",class:"v-data-table-header__sort-icon",icon:S(h)},null),e.multiSort&&s(h)&&u("div",{key:"badge",class:["v-data-table-header__sort-badge",...f.value],style:v.value},[d.value.findIndex(O=>O.key===h.key)+1])])}})};q(()=>u(M,null,[a.headers?a.headers(p.value):g.value.map((w,h)=>u("tr",null,[w.map((C,F)=>u(_,{column:C,x:F,y:h},null))])),e.loading&&u("tr",{class:"v-data-table-progress"},[u("th",{colspan:m.value.length},[u(yt,{name:"v-data-table-progress",active:!0,color:typeof e.loading=="boolean"?void 0:e.loading,indeterminate:!0},{default:a.loader})])])]))}}),Nt=T({groupBy:{type:Array,default:()=>[]}},"DataTable-group"),Qe=Symbol.for("vuetify:data-table-group");function Je(e){return{groupBy:z(e,"groupBy")}}function Xe(e){const{groupBy:l,sortBy:a}=e,t=E(new Set),n=x(()=>l.value.map(r=>({...r,order:r.order??!1})).concat(a.value));function d(r){return t.value.has(r.id)}function s(r){const i=new Set(t.value);d(r)?i.delete(r.id):i.add(r.id),t.value=i}function c(r){function i(m){const g=[];for(const y of m.items)"type"in y&&y.type==="group"?g.push(...i(y)):g.push(y);return g}return i({type:"group",items:r,id:"dummy",key:"dummy",value:"dummy",depth:0})}const o={sortByWithGroups:n,toggleGroup:s,opened:t,groupBy:l,extractRows:c,isGroupOpen:d};return $(Qe,o),o}function Ye(){const e=U(Qe);if(!e)throw new Error("Missing group!");return e}function Lt(e,l){if(!e.length)return[];const a=new Map;for(const t of e){const n=pe(t.raw,l);a.has(n)||a.set(n,[]),a.get(n).push(t)}return a}function Ze(e,l){let a=arguments.length>2&&arguments[2]!==void 0?arguments[2]:0,t=arguments.length>3&&arguments[3]!==void 0?arguments[3]:"root";if(!l.length)return[];const n=Lt(e,l[0]),d=[],s=l.slice(1);return n.forEach((c,o)=>{const r=l[0],i=`${t}_${r}_${o}`;d.push({depth:a,id:i,key:r,value:o,items:s.length?Ze(c,s,a+1,i):c,type:"group"})}),d}function qe(e,l){const a=[];for(const t of e)"type"in t&&t.type==="group"?(t.value!=null&&a.push(t),(l.has(t.id)||t.value==null)&&a.push(...qe(t.items,l))):a.push(t);return a}function et(e,l,a){return{flatItems:x(()=>{if(!l.value.length)return e.value;const n=Ze(e.value,l.value.map(d=>d.key));return qe(n,a.value)})}}const Gt=T({item:{type:Object,required:!0}},"VDataTableGroupHeaderRow"),Rt=W()({name:"VDataTableGroupHeaderRow",props:Gt(),setup(e,l){let{slots:a}=l;const{isGroupOpen:t,toggleGroup:n,extractRows:d}=Ye(),{isSelected:s,isSomeSelected:c,select:o}=se(),{columns:r}=ue(),i=x(()=>d([e.item]));return()=>u("tr",{class:"v-data-table-group-header-row",style:{"--v-data-table-group-header-row-depth":e.item.depth}},[r.value.map(m=>{var g,y;if(m.key==="data-table-group"){const b=t(e.item)?"$expand":"$next",S=()=>n(e.item);return((g=a["data-table-group"])==null?void 0:g.call(a,{item:e.item,count:i.value.length,props:{icon:b,onClick:S}}))??u(Pe,{class:"v-data-table-group-header-row__column"},{default:()=>[u(V,{size:"small",variant:"text",icon:b,onClick:S},null),u("span",null,[e.item.value]),u("span",null,[H("("),i.value.length,H(")")])]})}if(m.key==="data-table-select"){const b=s(i.value),S=c(i.value)&&!b,f=v=>o(i.value,v);return((y=a["data-table-select"])==null?void 0:y.call(a,{props:{modelValue:b,indeterminate:S,"onUpdate:modelValue":f}}))??u("td",null,[u(xe,{modelValue:b,indeterminate:S,"onUpdate:modelValue":f},null)])}return u("td",null,null)})])}}),Ht=T({expandOnClick:Boolean,showExpand:Boolean,expanded:{type:Array,default:()=>[]}},"DataTable-expand"),tt=Symbol.for("vuetify:datatable:expanded");function at(e){const l=k(e,"expandOnClick"),a=z(e,"expanded",e.expanded,c=>new Set(c),c=>[...c.values()]);function t(c,o){const r=new Set(a.value);o?r.add(c.value):r.delete(c.value),a.value=r}function n(c){return a.value.has(c.value)}function d(c){t(c,!n(c))}const s={expand:t,expanded:a,expandOnClick:l,isExpanded:n,toggleExpand:d};return $(tt,s),s}function lt(){const e=U(tt);if(!e)throw new Error("foo");return e}const Kt=T({index:Number,item:Object,onClick:Function},"VDataTableRow"),jt=ht({name:"VDataTableRow",props:Kt(),setup(e,l){let{slots:a}=l;const{isSelected:t,toggleSelect:n}=se(),{isExpanded:d,toggleExpand:s}=lt(),{columns:c}=ue();q(()=>u("tr",{class:["v-data-table__tr",{"v-data-table__tr--clickable":!!e.onClick}],onClick:e.onClick},[e.item&&c.value.map((o,r)=>u(Pe,{align:o.align,fixed:o.fixed,fixedOffset:o.fixedOffset,lastFixed:o.lastFixed,noPadding:o.key==="data-table-select"||o.key==="data-table-expand",width:o.width},{default:()=>{var y,b;const i=e.item,m=`item.${o.key}`,g={index:e.index,item:e.item,columns:c.value,isSelected:t,toggleSelect:n,isExpanded:d,toggleExpand:s};return a[m]?a[m](g):o.key==="data-table-select"?((y=a["item.data-table-select"])==null?void 0:y.call(a,g))??u(xe,{disabled:!i.selectable,modelValue:t([i]),onClick:Ce(()=>n(i),["stop"])},null):o.key==="data-table-expand"?((b=a["item.data-table-expand"])==null?void 0:b.call(a,g))??u(V,{icon:d(i)?"$collapse":"$expand",size:"small",variant:"text",onClick:Ce(()=>s(i),["stop"])},null):Z(i.columns,o.key)}}))]))}}),nt=T({loading:[Boolean,String],loadingText:{type:String,default:"$vuetify.dataIterator.loadingText"},hideNoData:Boolean,items:{type:Array,default:()=>[]},noDataText:{type:String,default:"$vuetify.noDataText"},rowHeight:Number,"onClick:row":Function},"VDataTableRows"),oe=W()({name:"VDataTableRows",props:nt(),setup(e,l){let{emit:a,slots:t}=l;const{columns:n}=ue(),{expandOnClick:d,toggleExpand:s,isExpanded:c}=lt(),{isSelected:o,toggleSelect:r}=se(),{toggleGroup:i,isGroupOpen:m}=Ye(),{t:g}=Se();return q(()=>{var y;return e.loading&&t.loading?u("tr",{class:"v-data-table-rows-loading",key:"loading"},[u("td",{colspan:n.value.length},[t.loading()])]):!e.loading&&!e.items.length&&!e.hideNoData?u("tr",{class:"v-data-table-rows-no-data",key:"no-data"},[u("td",{colspan:n.value.length},[((y=t["no-data"])==null?void 0:y.call(t))??g(e.noDataText)])]):u(M,null,[e.items.map((b,S)=>{var p;if(b.type==="group")return t["group-header"]?t["group-header"]({index:S,item:b,columns:n.value,isExpanded:c,toggleExpand:s,isSelected:o,toggleSelect:r,toggleGroup:i,isGroupOpen:m}):u(Rt,{key:`group-header_${b.id}`,item:b},t);const f={index:S,item:b,columns:n.value,isExpanded:c,toggleExpand:s,isSelected:o,toggleSelect:r},v={...f,props:{key:`item_${b.value}`,onClick:d.value||e["onClick:row"]?_=>{var w;d.value&&s(b),(w=e["onClick:row"])==null||w.call(e,_,{item:b})}:void 0,index:S,item:b}};return u(M,null,[t.item?t.item(v):u(jt,v.props,t),c(b)&&((p=t["expanded-row"])==null?void 0:p.call(t,f))])})])}),{}}}),zt=T({items:{type:Array,default:()=>[]},itemValue:{type:[String,Array,Function],default:"id"},itemSelectable:{type:[String,Array,Function],default:null},returnObject:Boolean},"DataTable-items");function Ut(e,l,a,t){const n=e.returnObject?l:Z(l,e.itemValue),d=Z(l,e.itemSelectable,!0),s=t.reduce((c,o)=>(c[o.key]=Z(l,o.value??o.key),c),{});return{type:"item",index:a,value:n,selectable:d,columns:s,raw:l}}function Wt(e,l,a){return l.map((t,n)=>Ut(e,t,n,a))}function rt(e,l){return{items:x(()=>Wt(e,e.items,l.value))}}function ot(e){let{page:l,itemsPerPage:a,sortBy:t,groupBy:n,search:d}=e;const s=pt("VDataTable"),c=x(()=>({page:l.value,itemsPerPage:a.value,sortBy:t.value,groupBy:n.value,search:d.value}));ye(()=>d==null?void 0:d.value,()=>{l.value=1});let o=null;ye(c,()=>{St(o,c.value)||(s.emit("update:options",c.value),o=c.value)},{deep:!0,immediate:!0})}const Qt=(e,l,a)=>e==null||l==null?-1:e.toString().toLocaleLowerCase().indexOf(l.toString().toLocaleLowerCase()),Jt=T({customFilter:Function,customKeyFilter:Object,filterKeys:[Array,String],filterMode:{type:String,default:"intersection"},noFilter:Boolean},"filter");function Xt(e,l,a){var c;const t=[],n=(a==null?void 0:a.default)??Qt,d=a!=null&&a.filterKeys?he(a.filterKeys):!1,s=Object.keys((a==null?void 0:a.customKeyFilter)??{}).length;if(!(e!=null&&e.length))return t;e:for(let o=0;o<e.length;o++){const r=e[o],i={},m={};let g=-1;if(l&&!(a!=null&&a.noFilter)){if(typeof r=="object"){const S=d||Object.keys(r);for(const f of S){const v=Z(r,f,r),p=(c=a==null?void 0:a.customKeyFilter)==null?void 0:c[f];if(g=p?p(v,l,r):n(v,l,r),g!==-1&&g!==!1)p?i[f]=g:m[f]=g;else if((a==null?void 0:a.filterMode)==="every")continue e}}else g=n(r,l,r),g!==-1&&g!==!1&&(m.title=g);const y=Object.keys(m).length,b=Object.keys(i).length;if(!y&&!b||(a==null?void 0:a.filterMode)==="union"&&b!==s&&!y||(a==null?void 0:a.filterMode)==="intersection"&&(b!==s||!y))continue}t.push({index:o,matches:{...m,...i}})}return t}function Yt(e,l,a,t){const n=x(()=>typeof(a==null?void 0:a.value)!="string"&&typeof(a==null?void 0:a.value)!="number"?"":String(a.value)),d=E([]),s=E(new Map),c=x(()=>t!=null&&t.transform?Y(l).map(t==null?void 0:t.transform):Y(l));Fe(()=>{d.value=[],s.value=new Map;const r=Xt(c.value,n.value,{customKeyFilter:e.customKeyFilter,default:e.customFilter,filterKeys:e.filterKeys,filterMode:e.filterMode,noFilter:e.noFilter}),i=Y(l);r.forEach(m=>{let{index:g,matches:y}=m;const b=i[g];d.value.push(b),s.value.set(b.value,y)})});function o(r){return s.value.get(r.value)}return{filteredItems:d,filteredMatches:s,getMatches:o}}const ut=T({...nt(),width:[String,Number],search:String,...Ht(),...Nt(),...Bt(),...zt(),...Ot(),...At(),...We(),...wt()},"DataTable"),Zt=T({...Ae(),...ut(),...Jt(),...we()},"VDataTable");W()({name:"VDataTable",props:Zt(),emits:{"update:modelValue":e=>!0,"update:page":e=>!0,"update:itemsPerPage":e=>!0,"update:sortBy":e=>!0,"update:options":e=>!0,"update:groupBy":e=>!0,"update:expanded":e=>!0},setup(e,l){let{emit:a,slots:t}=l;const{groupBy:n}=Je(e),{sortBy:d,multiSort:s,mustSort:c}=ze(e),{page:o,itemsPerPage:r}=Me(e),{columns:i,headers:m}=Le(e,{groupBy:n,showSelect:k(e,"showSelect"),showExpand:k(e,"showExpand")}),{items:g}=rt(e,i),y=k(e,"search"),{filteredItems:b}=Yt(e,g,y,{transform:R=>R.columns}),{toggleSort:S}=Ue({sortBy:d,multiSort:s,mustSort:c,page:o}),{sortByWithGroups:f,opened:v,extractRows:p,isGroupOpen:_,toggleGroup:w}=Xe({groupBy:n,sortBy:d}),{sortedItems:h}=Mt(e,b,f),{flatItems:C}=et(h,n,v),F=x(()=>C.value.length),{startIndex:Q,stopIndex:N,pageCount:L,setItemsPerPage:G}=$e({page:o,itemsPerPage:r,itemsLength:F}),{paginatedItems:O}=Ct({items:C,startIndex:Q,stopIndex:N,itemsPerPage:r}),ee=x(()=>p(O.value)),{isSelected:ie,select:I,selectAll:ce,toggleSelect:de,someSelected:fe,allSelected:ge}=Ke(e,{allItems:g,currentPage:ee}),{isExpanded:A,toggleExpand:te}=at(e);ot({page:o,itemsPerPage:r,sortBy:d,groupBy:n,search:y}),Oe({VDataTableRows:{hideNoData:k(e,"hideNoData"),noDataText:k(e,"noDataText"),loading:k(e,"loading"),loadingText:k(e,"loadingText")}});const D=x(()=>({page:o.value,itemsPerPage:r.value,sortBy:d.value,pageCount:L.value,toggleSort:S,setItemsPerPage:G,someSelected:fe.value,allSelected:ge.value,isSelected:ie,select:I,selectAll:ce,toggleSelect:de,isExpanded:A,toggleExpand:te,isGroupOpen:_,toggleGroup:w,items:ee.value,groupedItems:O.value,columns:i.value,headers:m.value}));return q(()=>{const[R]=ne.filterProps(e),[st]=re.filterProps(e),[it]=oe.filterProps(e),[ct]=le.filterProps(e);return u(le,K({class:["v-data-table",{"v-data-table--show-select":e.showSelect,"v-data-table--loading":e.loading},e.class],style:e.style},ct),{top:()=>{var J;return(J=t.top)==null?void 0:J.call(t,D.value)},default:()=>{var J,ke,Te,Ve;return t.default?t.default(D.value):u(M,null,[(J=t.colgroup)==null?void 0:J.call(t,D.value),u("thead",null,[u(re,st,t)]),(ke=t.thead)==null?void 0:ke.call(t,D.value),u("tbody",null,[t.body?t.body(D.value):u(oe,K(it,{items:O.value}),t)]),(Te=t.tbody)==null?void 0:Te.call(t,D.value),(Ve=t.tfoot)==null?void 0:Ve.call(t,D.value)])},bottom:()=>t.bottom?t.bottom(D.value):u(M,null,[u(ne,R,{prepend:t["footer.prepend"]})])})}),{}}});const qt=T({itemsLength:{type:[Number,String],required:!0},...Ae(),...ut(),...we()},"VDataTableServer"),oa=W()({name:"VDataTableServer",props:qt(),emits:{"update:modelValue":e=>!0,"update:page":e=>!0,"update:itemsPerPage":e=>!0,"update:sortBy":e=>!0,"update:options":e=>!0,"update:expanded":e=>!0,"update:groupBy":e=>!0,"click:row":(e,l)=>!0},setup(e,l){let{emit:a,slots:t}=l;const{groupBy:n}=Je(e),{sortBy:d,multiSort:s,mustSort:c}=ze(e),{page:o,itemsPerPage:r}=Me(e),i=x(()=>parseInt(e.itemsLength,10)),{columns:m,headers:g}=Le(e,{groupBy:n,showSelect:k(e,"showSelect"),showExpand:k(e,"showExpand")}),{items:y}=rt(e,m),{toggleSort:b}=Ue({sortBy:d,multiSort:s,mustSort:c,page:o}),{opened:S,isGroupOpen:f,toggleGroup:v,extractRows:p}=Xe({groupBy:n,sortBy:d}),{pageCount:_,setItemsPerPage:w}=$e({page:o,itemsPerPage:r,itemsLength:i}),{flatItems:h}=et(y,n,S),{isSelected:C,select:F,selectAll:Q,toggleSelect:N,someSelected:L,allSelected:G}=Ke(e,{allItems:y,currentPage:y}),{isExpanded:O,toggleExpand:ee}=at(e),ie=x(()=>p(y.value));ot({page:o,itemsPerPage:r,sortBy:d,groupBy:n,search:k(e,"search")}),$("v-data-table",{toggleSort:b,sortBy:d}),Oe({VDataTableRows:{hideNoData:k(e,"hideNoData"),noDataText:k(e,"noDataText"),loading:k(e,"loading"),loadingText:k(e,"loadingText")}});const I=x(()=>({page:o.value,itemsPerPage:r.value,sortBy:d.value,pageCount:_.value,toggleSort:b,setItemsPerPage:w,someSelected:L.value,allSelected:G.value,isSelected:C,select:F,selectAll:Q,toggleSelect:N,isExpanded:O,toggleExpand:ee,isGroupOpen:f,toggleGroup:v,items:ie.value,groupedItems:h.value,columns:m.value,headers:g.value}));q(()=>{const[ce]=ne.filterProps(e),[de]=re.filterProps(e),[fe]=oe.filterProps(e),[ge]=le.filterProps(e);return u(le,K({class:["v-data-table",{"v-data-table--loading":e.loading},e.class],style:e.style},ge),{top:()=>{var A;return(A=t.top)==null?void 0:A.call(t,I.value)},default:()=>{var A,te,D,R;return t.default?t.default(I.value):u(M,null,[(A=t.colgroup)==null?void 0:A.call(t,I.value),u("thead",{class:"v-data-table__thead",role:"rowgroup"},[u(re,K(de,{sticky:e.fixedHeader}),t)]),(te=t.thead)==null?void 0:te.call(t,I.value),u("tbody",{class:"v-data-table__tbody",role:"rowgroup"},[t.body?t.body(I.value):u(oe,K(fe,{items:h.value}),t)]),(D=t.tbody)==null?void 0:D.call(t,I.value),(R=t.tfoot)==null?void 0:R.call(t,I.value)])},bottom:()=>t.bottom?t.bottom(I.value):u(ne,ce,{prepend:t["footer.prepend"]})})})}});export{oa as V,ra as _};
