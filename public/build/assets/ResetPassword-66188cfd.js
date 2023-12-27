import{D as f,o as q,aT as g,r as m,f as _,d as l,b as s,u as e,w as a,aR as I,a as V,g as b,t as N,a6 as T,V as F,E as j,e as D}from"./main-c40ee4ed.js";import{u as E}from"./auth-ab955ed6.js";import{a as L,b as U}from"./auth-v1-top-shape-9eb39691.js";import{V as M,r as w,e as $}from"./VForm-48297921.js";import{V as v}from"./VImg-3d39c17f.js";import{V as A,b as z,a as k}from"./VCard-a375baf5.js";import{a as G,V as i}from"./VRow-db2c24e9.js";import{V as h}from"./VTextField-1b1d5e52.js";import"./axios-da837377.js";import"./parse-263515be.js";import"./index.m-120058be.js";import"./VInput-135e03cb.js";import"./transition-127812ba.js";import"./forwardRefs-9d31fcaa.js";import"./VAvatar-1c4c29a7.js";const H={class:"layout-wrapper layout-blank"},J={class:"auth-wrapper d-flex align-center justify-center pa-4"},K={class:"position-relative my-sm-16"},O={class:"d-flex"},Q=["src"],W=["src"],X=l("h5",{class:"text-h5 font-weight-semibold mb-1"}," Reset Password 🔒 ",-1),Y={class:"mb-0"},Z={class:"font-weight-bold"},ee=l("span",null,"Back to login",-1),we={__name:"ResetPassword",setup(se){const n=I(),{resetPassword:x,errors:u,respData:C,isBusy:P}=E(),B=f.app.theme.value==="light";q(()=>{(!n.query.email||!n.query.token)&&g.push({name:"login"})});const t=m({password:"",password_confirmation:"",email:n.query.email,token:n.query.token}),y=m(),R=()=>{var c;(c=y.value)==null||c.validate().then(async({valid:o})=>{o&&(await x(t.value),C.value.status===200&&g.push({name:"login"}))})},d=m(!1),p=m(!1);return(c,o)=>{const S=D("RouterLink");return V(),_("div",H,[l("div",J,[l("div",K,[s(v,{src:e(L),class:"auth-v1-top-shape d-none d-sm-block"},null,8,["src"]),s(v,{src:e(U),class:"auth-v1-bottom-shape d-none d-sm-block"},null,8,["src"]),s(A,{class:"auth-card pa-4","max-width":"448"},{default:a(()=>[s(z,{class:"justify-center"},{prepend:a(()=>[l("div",O,[B?(V(),_("img",{key:0,src:e(f).app.logo,class:"w-100",style:{height:"60px"}},null,8,Q)):(V(),_("img",{key:1,src:e(f).app.logoBlack,class:"w-100",style:{height:"60px"}},null,8,W))])]),_:1}),s(k,{class:"pt-2"},{default:a(()=>[X,l("p",Y,[b(" for "),l("span",Z,N(e(n).query.email),1)])]),_:1}),s(k,null,{default:a(()=>[s(M,{ref_key:"refVForm",ref:y,onSubmit:T(R,["prevent"])},{default:a(()=>[s(G,null,{default:a(()=>[s(i,{cols:"12"},{default:a(()=>[s(h,{modelValue:e(t).email,"onUpdate:modelValue":o[0]||(o[0]=r=>e(t).email=r),label:"Email",type:"email",rules:[e(w),e($)],"error-messages":e(u).email},null,8,["modelValue","rules","error-messages"])]),_:1}),s(i,{cols:"12"},{default:a(()=>[s(h,{modelValue:e(t).password,"onUpdate:modelValue":o[1]||(o[1]=r=>e(t).password=r),label:"New Password",rules:[e(w)],"error-messages":e(u).password,type:e(d)?"text":"password","append-inner-icon":e(d)?"tabler-eye-off":"tabler-eye","onClick:appendInner":o[2]||(o[2]=r=>d.value=!e(d))},null,8,["modelValue","rules","error-messages","type","append-inner-icon"])]),_:1}),s(i,{cols:"12"},{default:a(()=>[s(h,{modelValue:e(t).password_confirmation,"onUpdate:modelValue":o[3]||(o[3]=r=>e(t).password_confirmation=r),label:"Confirm Password",rules:[e(w)],"error-messages":e(u).password_confirmation,type:e(p)?"text":"password","append-inner-icon":e(p)?"tabler-eye-off":"tabler-eye","onClick:appendInner":o[4]||(o[4]=r=>p.value=!e(p))},null,8,["modelValue","rules","error-messages","type","append-inner-icon"])]),_:1}),s(i,{cols:"12"},{default:a(()=>[s(F,{block:"",type:"submit",loading:e(P)},{default:a(()=>[b(" Set New Password ")]),_:1},8,["loading"])]),_:1}),s(i,{cols:"12"},{default:a(()=>[s(S,{class:"d-flex align-center justify-center",to:{name:"login"}},{default:a(()=>[s(j,{icon:"tabler-chevron-left",class:"flip-in-rtl"}),ee]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1})]),_:1})])])])}}};export{we as default};
