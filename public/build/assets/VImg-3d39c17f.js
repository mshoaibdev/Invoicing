import{H as O,ai as B,bN as A,I as C,bO as L,J as F,b as n,k as h,c7 as W,au as _,r as J,a5 as I,ba as K,af as U,Z as w,aN as Z,F as G,K as Q,$ as X}from"./main-c40ee4ed.js";import{m as Y,M as b}from"./transition-127812ba.js";function p(e){return{aspectStyles:h(()=>{const u=Number(e.aspectRatio);return u?{paddingBottom:String(1/u*100)+"%"}:void 0})}}const j=O({aspectRatio:[String,Number],contentClass:String,inline:Boolean,...B(),...A()},"VResponsive"),T=C()({name:"VResponsive",props:j(),setup(e,u){let{slots:l}=u;const{aspectStyles:r}=p(e),{dimensionStyles:d}=L(e);return F(()=>{var a;return n("div",{class:["v-responsive",{"v-responsive--inline":e.inline},e.class],style:[d.value,e.style]},[n("div",{class:"v-responsive__sizer",style:r.value},null),(a=l.additional)==null?void 0:a.call(l),l.default&&n("div",{class:["v-responsive__content",e.contentClass]},[l.default()])])}),{}}});function ee(e,u){if(!W)return;const l=u.modifiers||{},r=u.value,{handler:d,options:a}=typeof r=="object"?r:{handler:r,options:{}},i=new IntersectionObserver(function(){var f;let m=arguments.length>0&&arguments[0]!==void 0?arguments[0]:[],g=arguments.length>1?arguments[1]:void 0;const s=(f=e._observe)==null?void 0:f[u.instance.$.uid];if(!s)return;const c=m.some(S=>S.isIntersecting);d&&(!l.quiet||s.init)&&(!l.once||c||s.init)&&d(c,m,g),c&&l.once?D(e,u):s.init=!0},a);e._observe=Object(e._observe),e._observe[u.instance.$.uid]={init:!1,observer:i},i.observe(e)}function D(e,u){var r;const l=(r=e._observe)==null?void 0:r[u.instance.$.uid];l&&(l.observer.unobserve(e),delete e._observe[u.instance.$.uid])}const te={mounted:ee,unmounted:D},ne=te,re=O({alt:String,cover:Boolean,eager:Boolean,gradient:String,lazySrc:String,options:{type:Object,default:()=>({root:void 0,rootMargin:void 0,threshold:void 0})},sizes:String,src:{type:[String,Object],default:""},srcset:String,...j(),...B(),...Y()},"VImg"),le=C()({name:"VImg",directives:{intersect:ne},props:re(),emits:{loadstart:e=>!0,load:e=>!0,error:e=>!0},setup(e,u){let{emit:l,slots:r}=u;const d=_(""),a=J(),i=_(e.eager?"loading":"idle"),m=_(),g=_(),s=h(()=>e.src&&typeof e.src=="object"?{src:e.src.src,srcset:e.srcset||e.src.srcset,lazySrc:e.lazySrc||e.src.lazySrc,aspect:Number(e.aspectRatio||e.src.aspect||0)}:{src:e.src,srcset:e.srcset,lazySrc:e.lazySrc,aspect:Number(e.aspectRatio||0)}),c=h(()=>s.value.aspect||m.value/g.value||0);I(()=>e.src,()=>{f(i.value!=="idle")}),I(c,(t,o)=>{!t&&o&&a.value&&y(a.value)}),K(()=>f());function f(t){if(!(e.eager&&t)&&!(W&&!t&&!e.eager)){if(i.value="loading",s.value.lazySrc){const o=new Image;o.src=s.value.lazySrc,y(o,null)}s.value.src&&U(()=>{var o,v;if(l("loadstart",((o=a.value)==null?void 0:o.currentSrc)||s.value.src),(v=a.value)!=null&&v.complete){if(a.value.naturalWidth||z(),i.value==="error")return;c.value||y(a.value,null),S()}else c.value||y(a.value),R()})}}function S(){var t;R(),i.value="loaded",l("load",((t=a.value)==null?void 0:t.currentSrc)||s.value.src)}function z(){var t;i.value="error",l("error",((t=a.value)==null?void 0:t.currentSrc)||s.value.src)}function R(){const t=a.value;t&&(d.value=t.currentSrc||t.src)}let V=-1;function y(t){let o=arguments.length>1&&arguments[1]!==void 0?arguments[1]:100;const v=()=>{clearTimeout(V);const{naturalHeight:$,naturalWidth:k}=t;$||k?(m.value=k,g.value=$):!t.complete&&i.value==="loading"&&o!=null?V=window.setTimeout(v,o):(t.currentSrc.endsWith(".svg")||t.currentSrc.startsWith("data:image/svg+xml"))&&(m.value=1,g.value=1)};v()}const P=h(()=>({"v-img__img--cover":e.cover,"v-img__img--contain":!e.cover})),E=()=>{var v;if(!s.value.src||i.value==="idle")return null;const t=n("img",{class:["v-img__img",P.value],src:s.value.src,srcset:s.value.srcset,alt:e.alt,sizes:e.sizes,ref:a,onLoad:S,onError:z},null),o=(v=r.sources)==null?void 0:v.call(r);return n(b,{transition:e.transition,appear:!0},{default:()=>[w(o?n("picture",{class:"v-img__picture"},[o,t]):t,[[X,i.value==="loaded"]])]})},H=()=>n(b,{transition:e.transition},{default:()=>[s.value.lazySrc&&i.value!=="loaded"&&n("img",{class:["v-img__img","v-img__img--preload",P.value],src:s.value.lazySrc,alt:e.alt},null)]}),M=()=>r.placeholder?n(b,{transition:e.transition,appear:!0},{default:()=>[(i.value==="loading"||i.value==="error"&&!r.error)&&n("div",{class:"v-img__placeholder"},[r.placeholder()])]}):null,q=()=>r.error?n(b,{transition:e.transition,appear:!0},{default:()=>[i.value==="error"&&n("div",{class:"v-img__error"},[r.error()])]}):null,x=()=>e.gradient?n("div",{class:"v-img__gradient",style:{backgroundImage:`linear-gradient(${e.gradient})`}},null):null,N=_(!1);{const t=I(c,o=>{o&&(requestAnimationFrame(()=>{requestAnimationFrame(()=>{N.value=!0})}),t())})}return F(()=>{const[t]=T.filterProps(e);return w(n(T,Q({class:["v-img",{"v-img--booting":!N.value},e.class],style:e.style},t,{aspectRatio:c.value,"aria-label":e.alt,role:e.alt?"img":void 0}),{additional:()=>n(G,null,[n(E,null,null),n(H,null,null),n(x,null,null),n(M,null,null),n(q,null,null)]),default:r.default}),[[Z("intersect"),{handler:f,options:e.options},null,{once:!0}]])}),{currentSrc:d,image:a,state:i,naturalWidth:m,naturalHeight:g}}});export{ne as I,le as V};