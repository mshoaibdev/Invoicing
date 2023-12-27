import{a3 as N,bJ as P,r as m,bE as f,a5 as I,a8 as j,e as J,a as l,c as g,w as t,b as a,u as r,U as O,bK as B,d as o,E as u,S as X,Z as w,f as d,F as b,p as S,g as K,t as v,A as D,$,h as L,ab as Z,ac as G}from"./main-c40ee4ed.js";import{V as H,a as A}from"./VCard-a375baf5.js";import{V as W}from"./VTextField-1b1d5e52.js";import{V as Y}from"./VDivider-e4e61359.js";import{V as R,f as ee,a as z,b as se}from"./VList-4b19a862.js";import{a as te,V as ae}from"./VRow-db2c24e9.js";import{V as re}from"./VDialog-fe67dd57.js";import"./VAvatar-1c4c29a7.js";import"./VImg-3d39c17f.js";import"./transition-127812ba.js";import"./VInput-135e03cb.js";import"./forwardRefs-9d31fcaa.js";import"./VOverlay-93ac4317.js";const Q=_=>(Z("data-v-1a7e993d"),_=_(),G(),_),le={class:"d-flex align-center text-high-emphasis me-1"},oe={class:"d-flex align-center"},ie={class:"h-100"},ne={class:"text-xs text-disabled text-uppercase"},ce={class:"h-100"},ue={class:"app-bar-search-suggestions d-flex flex-column align-center justify-center text-high-emphasis h-100"},de={class:"d-flex align-center flex-wrap justify-center gap-2 text-h6 my-3"},pe=Q(()=>o("span",null,"No Result For ",-1)),he={key:0,class:"mt-8"},fe=Q(()=>o("span",{class:"d-flex justify-center text-disabled"},"Try searching for",-1)),_e=["onClick"],ye={class:"text-sm"},me={__name:"AppBarSearch",props:{isDialogVisible:{type:Boolean,required:!0},searchQuery:{type:String,required:!0},searchResults:{type:Array,required:!0},suggestions:{type:Array,required:!1},noDataSuggestion:{type:Array,required:!1}},emits:["update:isDialogVisible","update:searchQuery","itemSelected"],setup(_,{emit:y}){const i=_,{ctrl_k:F,meta_k:T}=P({passive:!1,onEventFired(e){e.ctrlKey&&e.key==="k"&&e.type==="keydown"&&e.preventDefault()}}),x=m(),n=m(structuredClone(f(i.searchQuery))),U=m(),C=m(structuredClone(f(i.isDialogVisible))),p=m(structuredClone(f(i.searchResults)));I(i,()=>{C.value=structuredClone(f(i.isDialogVisible)),p.value=structuredClone(f(i.searchResults)),n.value=structuredClone(f(i.searchQuery))}),I([F,T],()=>{C.value=!0,y("update:isDialogVisible",!0)});const V=()=>{y("update:isDialogVisible",!1),y("update:searchQuery","")};j(()=>{n.value.length||(p.value=[])});const q=e=>{var c,k;e.key==="ArrowDown"?(e.preventDefault(),(c=x.value)==null||c.focus("next")):e.key==="ArrowUp"&&(e.preventDefault(),(k=x.value)==null||k.focus("prev"))},E=e=>{y("update:isDialogVisible",e),y("update:searchQuery","")},M=e=>e==="dashboards"?"Dashboards":e==="appsPages"?"Apps & Pages":e==="userInterface"?"User Interface":e==="formsTables"?"Forms Tables":e==="chartsMisc"?"Charts Misc":"Misc";return(e,c)=>{const k=J("IconBtn");return l(),g(re,{"max-width":"600","model-value":r(C),height:e.$vuetify.display.smAndUp?"550":"100%",fullscreen:e.$vuetify.display.width<600,class:"app-bar-search-dialog","onUpdate:modelValue":E,onKeyup:B(V,["esc"])},{default:t(()=>[a(H,{height:"100%",width:"100%",class:"position-relative"},{default:t(()=>[a(A,{class:"pt-1",style:{"min-block-size":"65px"}},{default:t(()=>[a(W,{ref_key:"refSearchInput",ref:U,modelValue:r(n),"onUpdate:modelValue":[c[0]||(c[0]=s=>O(n)?n.value=s:null),c[1]||(c[1]=s=>e.$emit("update:searchQuery",r(n)))],autofocus:"",density:"comfortable",variant:"plain",class:"app-bar-autocomplete-box",onKeyup:B(V,["esc"]),onKeydown:q},{"prepend-inner":t(()=>[o("div",le,[a(u,{size:"22",icon:"tabler-search",class:"mt-1",style:{opacity:"1"}})])]),"append-inner":t(()=>[o("div",oe,[o("div",{class:"text-base text-disabled cursor-pointer me-1",onClick:V}," [esc] "),a(k,{size:"small",onClick:V},{default:t(()=>[a(u,{icon:"tabler-x"})]),_:1})])]),_:1},8,["modelValue","onKeyup"])]),_:1}),a(Y),a(r(X),{options:{wheelPropagation:!1,suppressScrollX:!0},class:"h-100"},{default:t(()=>[w(a(r(R),{ref_key:"refSearchList",ref:x,density:"compact",class:"app-bar-search-list"},{default:t(()=>[(l(!0),d(b,null,S(r(p),s=>(l(),d(b,{key:s.title},["header"in s?(l(),g(r(ee),{key:0,class:"text-disabled"},{default:t(()=>[K(v(M(s.title)),1)]),_:2},1024)):D(e.$slots,"searchResult",{key:1,item:s},()=>[a(r(z),{link:"",onClick:h=>e.$emit("itemSelected",s)},{prepend:t(()=>[a(u,{size:"20",icon:s.icon,class:"me-3"},null,8,["icon"])]),append:t(()=>[a(u,{size:"20",icon:"tabler-corner-down-left",class:"enter-icon text-disabled"})]),default:t(()=>[a(se,null,{default:t(()=>[K(v(s.title),1)]),_:2},1024)]),_:2},1032,["onClick"])],!0)],64))),128))]),_:3},512),[[$,r(n).length&&!!r(p).length]]),w(o("div",ie,[D(e.$slots,"suggestions",{},()=>[a(A,{class:"app-bar-search-suggestions h-100 pa-10"},{default:t(()=>[i.suggestions?(l(),g(te,{key:0,class:"gap-y-4"},{default:t(()=>[(l(!0),d(b,null,S(i.suggestions,s=>(l(),g(ae,{key:s.title,cols:"12",sm:"6",class:"ps-6"},{default:t(()=>[o("p",ne,v(s.title),1),a(r(R),{class:"card-list"},{default:t(()=>[(l(!0),d(b,null,S(s.content,h=>(l(),g(r(z),{key:h.title,link:"",title:h.title,class:"app-bar-search-suggestion",onClick:ge=>e.$emit("itemSelected",h)},{prepend:t(()=>[a(u,{icon:h.icon,size:"20",class:"me-2"},null,8,["icon"])]),_:2},1032,["title","onClick"]))),128))]),_:2},1024)]),_:2},1024))),128))]),_:1})):L("",!0)]),_:1})],!0)],512),[[$,!!r(p)&&!r(n)]]),w(o("div",ce,[D(e.$slots,"noData",{},()=>[a(A,{class:"h-100"},{default:t(()=>[o("div",ue,[a(u,{size:"75",icon:"tabler-file-x"}),o("div",de,[pe,o("span",null,'"'+v(r(n))+'"',1)]),i.noDataSuggestion?(l(),d("div",he,[fe,(l(!0),d(b,null,S(i.noDataSuggestion,s=>(l(),d("h6",{key:s.title,class:"app-bar-search-suggestion text-sm font-weight-regular cursor-pointer mt-3",onClick:h=>e.$emit("itemSelected",s)},[a(u,{size:"20",icon:s.icon,class:"me-3"},null,8,["icon"]),o("span",ye,v(s.title),1)],8,_e))),128))])):L("",!0)])]),_:1})],!0)],512),[[$,!r(p).length&&r(n).length]])]),_:3})]),_:3})]),_:3},8,["model-value","height","fullscreen","onKeyup"])}}},Ke=N(me,[["__scopeId","data-v-1a7e993d"]]);export{Ke as default};
