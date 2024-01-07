import{bJ as Z,c5 as p,df as ee,bR as te,dj as ae,b_ as ne,da as le,l as y,aB as x,aQ as oe,bg as ue,am as ie,bf as m,ai as re,c4 as se,c9 as ce,ca as _,dg as de,y as l,di as fe,ab as R,F as I,bm as A,aH as ve,bb as xe,dk as me,dl as ge,ac as S,dm as he,bH as we,d1 as Ve}from"./main-70b82271.js";const ye=Z({autoGrow:Boolean,autofocus:Boolean,counter:[Boolean,Number,String],counterValue:Function,prefix:String,placeholder:String,persistentPlaceholder:Boolean,persistentCounter:Boolean,noResize:Boolean,rows:{type:[Number,String],default:5,validator:e=>!isNaN(parseFloat(e))},maxRows:{type:[Number,String],validator:e=>!isNaN(parseFloat(e))},suffix:String,modelModifiers:Object,...p(),...ee()},"VTextarea"),be=te()({name:"VTextarea",directives:{Intersect:ae},inheritAttrs:!1,props:ye(),emits:{"click:control":e=>!0,"mousedown:control":e=>!0,"update:focused":e=>!0,"update:modelValue":e=>!0},setup(e,z){let{attrs:F,emit:H,slots:i}=z;const o=ne(e,"modelValue"),{isFocused:f,focus:G,blur:D}=le(e),E=y(()=>typeof e.counterValue=="function"?e.counterValue(o.value):(o.value||"").toString().length),U=y(()=>{if(F.maxlength)return F.maxlength;if(!(!e.counter||typeof e.counter!="number"&&typeof e.counter!="string"))return e.counter});function O(t,n){var a,u;!e.autofocus||!t||(u=(a=n[0].target)==null?void 0:a.focus)==null||u.call(a)}const B=x(),g=x(),M=oe(""),h=x(),j=y(()=>e.persistentPlaceholder||f.value||e.active);function b(){var t;h.value!==document.activeElement&&((t=h.value)==null||t.focus()),f.value||G()}function $(t){b(),H("click:control",t)}function J(t){H("mousedown:control",t)}function Q(t){t.stopPropagation(),b(),S(()=>{o.value="",he(e["onClick:clear"],t)})}function q(t){var a;const n=t.target;if(o.value=n.value,(a=e.modelModifiers)!=null&&a.trim){const u=[n.selectionStart,n.selectionEnd];S(()=>{n.selectionStart=u[0],n.selectionEnd=u[1]})}}const c=x(),w=x(+e.rows),C=y(()=>["plain","underlined"].includes(e.variant));ue(()=>{e.autoGrow||(w.value=+e.rows)});function d(){e.autoGrow&&S(()=>{if(!c.value||!g.value)return;const t=getComputedStyle(c.value),n=getComputedStyle(g.value.$el),a=parseFloat(t.getPropertyValue("--v-field-padding-top"))+parseFloat(t.getPropertyValue("--v-input-padding-top"))+parseFloat(t.getPropertyValue("--v-field-padding-bottom")),u=c.value.scrollHeight,V=parseFloat(t.lineHeight),P=Math.max(parseFloat(e.rows)*V+a,parseFloat(n.getPropertyValue("--v-input-control-height"))),k=parseFloat(e.maxRows)*V+a||1/0,s=Ve(u??0,P,k);w.value=Math.floor((s-a)/V),M.value=we(s)})}ie(d),m(o,d),m(()=>e.rows,d),m(()=>e.maxRows,d),m(()=>e.density,d);let r;return m(c,t=>{t?(r=new ResizeObserver(d),r.observe(c.value)):r==null||r.disconnect()}),re(()=>{r==null||r.disconnect()}),se(()=>{const t=!!(i.counter||e.counter||e.counterValue),n=!!(t||i.details),[a,u]=ce(F),[{modelValue:V,...P}]=_.filterProps(e),[k]=de(e);return l(_,R({ref:B,modelValue:o.value,"onUpdate:modelValue":s=>o.value=s,class:["v-textarea v-text-field",{"v-textarea--prefixed":e.prefix,"v-textarea--suffixed":e.suffix,"v-text-field--prefixed":e.prefix,"v-text-field--suffixed":e.suffix,"v-textarea--auto-grow":e.autoGrow,"v-textarea--no-resize":e.noResize||e.autoGrow,"v-text-field--plain-underlined":C.value},e.class],style:e.style},a,P,{centerAffix:w.value===1&&!C.value,focused:f.value}),{...i,default:s=>{let{isDisabled:v,isDirty:N,isReadonly:K,isValid:L}=s;return l(fe,R({ref:g,style:{"--v-textarea-control-height":M.value},onClick:$,onMousedown:J,"onClick:clear":Q,"onClick:prependInner":e["onClick:prependInner"],"onClick:appendInner":e["onClick:appendInner"],role:"textbox"},k,{active:j.value||N.value,centerAffix:w.value===1&&!C.value,dirty:N.value||e.dirty,disabled:v.value,focused:f.value,error:L.value===!1}),{...i,default:W=>{let{props:{class:T,...X}}=W;return l(I,null,[e.prefix&&l("span",{class:"v-text-field__prefix"},[e.prefix]),A(l("textarea",R({ref:h,class:T,value:o.value,onInput:q,autofocus:e.autofocus,readonly:K.value,disabled:v.value,placeholder:e.placeholder,rows:e.rows,name:e.name,onFocus:b,onBlur:D},X,u),null),[[ve("intersect"),{handler:O},null,{once:!0}]]),e.autoGrow&&A(l("textarea",{class:[T,"v-textarea__sizer"],"onUpdate:modelValue":Y=>o.value=Y,ref:c,readonly:!0,"aria-hidden":"true"},null),[[xe,o.value]]),e.suffix&&l("span",{class:"v-text-field__suffix"},[e.suffix])])}})},details:n?s=>{var v;return l(I,null,[(v=i.details)==null?void 0:v.call(i,s),t&&l(I,null,[l("span",null,null),l(me,{active:e.persistentCounter||f.value,value:E.value,max:U.value},i.counter)])])}:void 0})}),ge({},B,g,h)}});export{be as V};
