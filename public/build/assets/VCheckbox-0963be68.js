import{m as g,V as t}from"./VCheckboxBtn-d416ecdf.js";import{bJ as A,c5 as F,c6 as I,bR as B,b_ as R,da as U,c8 as _,l as $,c4 as D,c9 as J,ca as l,y as u,ab as c}from"./main-70b82271.js";const M=A({...F(),...I(g(),["inline"])},"VCheckbox"),z=B()({name:"VCheckbox",inheritAttrs:!1,props:M(),emits:{"update:modelValue":e=>!0,"update:focused":e=>!0},setup(e,r){let{attrs:d,slots:a}=r;const s=R(e,"modelValue"),{isFocused:n,focus:i,blur:m}=U(e),b=_(),V=$(()=>e.id||`checkbox-${b}`);return D(()=>{const[p,k]=J(d),[v,N]=l.filterProps(e),[x,j]=t.filterProps(e);return u(l,c({class:["v-checkbox",e.class]},p,v,{modelValue:s.value,"onUpdate:modelValue":o=>s.value=o,id:V.value,focused:n.value,style:e.style}),{...a,default:o=>{let{id:f,messagesId:h,isDisabled:P,isReadonly:C}=o;return u(t,c(x,{id:f.value,"aria-describedby":h.value,disabled:P.value,readonly:C.value},k,{modelValue:s.value,"onUpdate:modelValue":y=>s.value=y,onFocus:i,onBlur:m}),a)}})}),{}}});export{z as V};
