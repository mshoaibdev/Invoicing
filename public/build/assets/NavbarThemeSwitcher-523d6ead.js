import{bz as _,cD as d,bf as f,aG as x,at as m,n as l,bk as o,y as r,cf as T,b0 as i,cz as b,q as y,aU as g}from"./main-70b82271.js";const v={class:"text-capitalize"},N={__name:"ThemeSwitcher",props:{themes:{type:Array,required:!0}},setup(c){const e=c,{theme:t}=_(),{state:n,next:s,index:h}=d(e.themes.map(a=>a.name),{initialValue:t.value}),p=()=>{t.value=s()};return f(t,a=>{n.value=a}),(a,k)=>{const u=x("IconBtn");return m(),l(u,{onClick:p},{default:o(()=>[r(T,{size:"26",icon:e.themes[i(h)].icon},null,8,["icon"]),r(b,{activator:"parent","open-delay":"1000","scroll-strategy":"close"},{default:o(()=>[y("span",v,g(i(n)),1)]),_:1})]),_:1})}}},B={__name:"NavbarThemeSwitcher",setup(c){const e=[{name:"system",icon:"tabler-device-laptop"},{name:"light",icon:"tabler-sun-high"},{name:"dark",icon:"tabler-moon"}];return(t,n)=>{const s=N;return m(),l(s,{themes:e})}}};export{B as default};