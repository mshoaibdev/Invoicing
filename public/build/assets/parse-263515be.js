import{ae as Q,l as ne,b as g,K as M,bE as P,af as Ne,bF as Oe,bG as ze,k as C,o as Te,bH as _e,F as Qe,r as U,n as X,a8 as Y,bI as Ge}from"./main-c40ee4ed.js";const K={TOP_LEFT:"top-left",TOP_RIGHT:"top-right",TOP_CENTER:"top-center",BOTTOM_LEFT:"bottom-left",BOTTOM_RIGHT:"bottom-right",BOTTOM_CENTER:"bottom-center"},k={LIGHT:"light",DARK:"dark",COLORED:"colored",AUTO:"auto"},N={INFO:"info",SUCCESS:"success",WARNING:"warning",ERROR:"error",DEFAULT:"default"},$e={BOUNCE:"bounce",SLIDE:"slide",FLIP:"flip",ZOOM:"zoom"},Ie={dangerouslyHTMLString:!1,multiple:!0,position:K.TOP_RIGHT,autoClose:5e3,transition:"bounce",hideProgressBar:!1,pauseOnHover:!0,pauseOnFocusLoss:!0,closeOnClick:!0,className:"",bodyClassName:"",style:{},progressClassName:"",progressStyle:{},role:"alert",theme:"light"},Ve={rtl:!1,newestOnTop:!1,toastClassName:""},Pe={...Ie,...Ve};({...Ie,type:N.DEFAULT});var p=(e=>(e[e.COLLAPSE_DURATION=300]="COLLAPSE_DURATION",e[e.DEBOUNCE_DURATION=50]="DEBOUNCE_DURATION",e.CSS_NAMESPACE="Toastify",e))(p||{}),de=(e=>(e.ENTRANCE_ANIMATION_END="d",e))(de||{});const Ke={enter:"Toastify--animate Toastify__bounce-enter",exit:"Toastify--animate Toastify__bounce-exit",appendPosition:!0},We={enter:"Toastify--animate Toastify__slide-enter",exit:"Toastify--animate Toastify__slide-exit",appendPosition:!0},Xe={enter:"Toastify--animate Toastify__zoom-enter",exit:"Toastify--animate Toastify__zoom-exit"},Ye={enter:"Toastify--animate Toastify__flip-enter",exit:"Toastify--animate Toastify__flip-exit"};function Le(e){let t=Ke;if(!e||typeof e=="string")switch(e){case"flip":t=Ye;break;case"zoom":t=Xe;break;case"slide":t=We;break}else t=e;return t}function Ze(e){return e.containerId||String(e.position)}const re="will-unmount";function Je(e=K.TOP_RIGHT){return!!document.querySelector(".".concat(p.CSS_NAMESPACE,"__toast-container--").concat(e))}function et(e=K.TOP_RIGHT){return"".concat(p.CSS_NAMESPACE,"__toast-container--").concat(e)}function tt(e,t,n=!1){const r=["".concat(p.CSS_NAMESPACE,"__toast-container"),"".concat(p.CSS_NAMESPACE,"__toast-container--").concat(e),n?"".concat(p.CSS_NAMESPACE,"__toast-container--rtl"):null].filter(Boolean).join(" ");return H(t)?t({position:e,rtl:n,defaultClassName:r}):"".concat(r," ").concat(t||"")}function nt(e){var t;const{position:n,containerClassName:r,rtl:o=!1,style:a={}}=e,i=p.CSS_NAMESPACE,c=et(n),l=document.querySelector(".".concat(i)),s=document.querySelector(".".concat(c)),u=!!s&&!((t=s.className)!=null&&t.includes(re)),v=l||document.createElement("div"),f=document.createElement("div");f.className=tt(n,r,o),f.dataset.testid="".concat(p.CSS_NAMESPACE,"__toast-container--").concat(n),f.id=Ze(e);for(const h in a)if(Object.prototype.hasOwnProperty.call(a,h)){const m=a[h];f.style[h]=m}return l||(v.className=p.CSS_NAMESPACE,document.body.appendChild(v)),u||v.appendChild(f),f}function fe(e){var t,n,r;const o=typeof e=="string"?e:((t=e.currentTarget)==null?void 0:t.id)||((n=e.target)==null?void 0:n.id),a=document.getElementById(o);a&&a.removeEventListener("animationend",fe,!1);try{V[o].unmount(),(r=document.getElementById(o))==null||r.remove(),delete V[o],delete b[o]}catch{}}const V=Q({});function rt(e,t){const n=document.getElementById(String(t));n&&(V[n.id]=e)}function pe(e,t=!0){const n=String(e);if(!V[n])return;const r=document.getElementById(n);r&&r.classList.add(re),t?(at(e),r&&r.addEventListener("animationend",fe,!1)):fe(n),x.items=x.items.filter(o=>o.containerId!==e)}function ot(e){for(const t in V)pe(t,e);x.items=[]}function we(e,t){const n=document.getElementById(e.toastId);if(n){let r=e;r={...r,...Le(r.transition)};const o=r.appendPosition?"".concat(r.exit,"--").concat(r.position):r.exit;n.className+=" ".concat(o),t&&t(n)}}function at(e){for(const t in b)if(t===e)for(const n of b[t]||[])we(n)}function it(e){const t=W().find(n=>n.toastId===e);return t==null?void 0:t.containerId}function Se(e){return document.getElementById(e)}function lt(e){const t=Se(e.containerId);return t&&t.classList.contains(re)}function be(e){var t;const n=Oe(e.content)?P(e.content.props):null;return n??P((t=e.data)!=null?t:{})}function st(e){return e?x.items.filter(t=>t.containerId===e).length>0:x.items.length>0}function ct(){if(x.items.length>0){const e=x.items.shift();Z(e==null?void 0:e.toastContent,e==null?void 0:e.toastProps)}}const b=Q({}),x=Q({items:[]});function W(){const e=P(b);return Object.values(e).reduce((t,n)=>[...t,...n],[])}function ut(e){return W().find(t=>t.toastId===e)}function Z(e,t={}){if(lt(t)){const n=Se(t.containerId);n&&n.addEventListener("animationend",me.bind(null,e,t),!1)}else me(e,t)}function me(e,t={}){const n=Se(t.containerId);n&&n.removeEventListener("animationend",me.bind(null,e,t),!1);const r=b[t.containerId]||[],o=r.length>0;if(!o&&!Je(t.position)){const a=nt(t),i=ze(Pt,t);i.mount(a),rt(i,a.id)}o&&(t.position=r[0].position),Ne(()=>{t.updateId?w.update(t):w.add(e,t)})}const w={add(e,t){const{containerId:n=""}=t;n&&(b[n]=b[n]||[],b[n].find(r=>r.toastId===t.toastId)||setTimeout(()=>{var r,o;t.newestOnTop?(r=b[n])==null||r.unshift(t):(o=b[n])==null||o.push(t),t.onOpen&&t.onOpen(be(t))},t.delay||0))},remove(e){if(e){const t=it(e);if(t){const n=b[t];let r=n.find(o=>o.toastId===e);b[t]=n.filter(o=>o.toastId!==e),!b[t].length&&!st(t)&&pe(t,!1),ct(),Ne(()=>{r!=null&&r.onClose&&(r.onClose(be(r)),r=void 0)})}}},update(e={}){const{containerId:t=""}=e;if(t&&e.updateId){b[t]=b[t]||[];const n=b[t].find(r=>r.toastId===e.toastId);n&&setTimeout(()=>{for(const r in e)if(Object.prototype.hasOwnProperty.call(e,r)){const o=e[r];n[r]=o}},e.delay||0)}},clear(e,t=!0){e?pe(e,t):ot(t)},dismissCallback(e){var t;const n=(t=e.currentTarget)==null?void 0:t.id,r=document.getElementById(n);r&&(r.removeEventListener("animationend",w.dismissCallback,!1),setTimeout(()=>{w.remove(n)}))},dismiss(e){if(e){const t=W();for(const n of t)if(n.toastId===e){we(n,r=>{r.addEventListener("animationend",w.dismissCallback,!1)});break}}}},xe=Q({}),te=Q({});function Fe(){return Math.random().toString(36).substring(2,9)}function dt(e){return typeof e=="number"&&!isNaN(e)}function ye(e){return typeof e=="string"}function H(e){return typeof e=="function"}function oe(...e){return M(...e)}function J(e){return typeof e=="object"&&(!!(e!=null&&e.render)||!!(e!=null&&e.setup)||typeof(e==null?void 0:e.type)=="object")}function ft(e={}){xe["".concat(p.CSS_NAMESPACE,"-default-options")]=e}function pt(){return xe["".concat(p.CSS_NAMESPACE,"-default-options")]||Pe}function mt(){return document.documentElement.classList.contains("dark")?"dark":"light"}var ee=(e=>(e[e.Enter=0]="Enter",e[e.Exit=1]="Exit",e))(ee||{});const Be={containerId:{type:[String,Number],required:!1,default:""},clearOnUrlChange:{type:Boolean,required:!1,default:!0},dangerouslyHTMLString:{type:Boolean,required:!1,default:!1},multiple:{type:Boolean,required:!1,default:!0},limit:{type:Number,required:!1,default:void 0},position:{type:String,required:!1,default:K.TOP_LEFT},bodyClassName:{type:String,required:!1,default:""},autoClose:{type:[Number,Boolean],required:!1,default:!1},closeButton:{type:[Boolean,Function,Object],required:!1,default:void 0},transition:{type:[String,Object],required:!1,default:"bounce"},hideProgressBar:{type:Boolean,required:!1,default:!1},pauseOnHover:{type:Boolean,required:!1,default:!0},pauseOnFocusLoss:{type:Boolean,required:!1,default:!0},closeOnClick:{type:Boolean,required:!1,default:!0},progress:{type:Number,required:!1,default:void 0},progressClassName:{type:String,required:!1,default:""},toastStyle:{type:Object,required:!1,default(){return{}}},progressStyle:{type:Object,required:!1,default(){return{}}},role:{type:String,required:!1,default:"alert"},theme:{type:String,required:!1,default:k.AUTO},content:{type:[String,Object,Function],required:!1,default:""},toastId:{type:[String,Number],required:!1,default:""},data:{type:[Object,String],required:!1,default(){return{}}},type:{type:String,required:!1,default:N.DEFAULT},icon:{type:[Boolean,String,Number,Object,Function],required:!1,default:void 0},delay:{type:Number,required:!1,default:void 0},onOpen:{type:Function,required:!1,default:void 0},onClose:{type:Function,required:!1,default:void 0},onClick:{type:Function,required:!1,default:void 0},isLoading:{type:Boolean,required:!1,default:void 0},rtl:{type:Boolean,required:!1,default:!1},toastClassName:{type:String,required:!1,default:""},updateId:{type:[String,Number],required:!1,default:""}},yt={autoClose:{type:[Number,Boolean],required:!0},isRunning:{type:Boolean,required:!1,default:void 0},type:{type:String,required:!1,default:N.DEFAULT},theme:{type:String,required:!1,default:k.AUTO},hide:{type:Boolean,required:!1,default:void 0},className:{type:[String,Function],required:!1,default:""},controlledProgress:{type:Boolean,required:!1,default:void 0},rtl:{type:Boolean,required:!1,default:void 0},isIn:{type:Boolean,required:!1,default:void 0},progress:{type:Number,required:!1,default:void 0},closeToast:{type:Function,required:!1,default:void 0}},vt=ne({name:"ProgressBar",props:yt,setup(e,{attrs:t}){const n=U(),r=C(()=>e.hide?"true":"false"),o=C(()=>({...t.style||{},animationDuration:"".concat(e.autoClose===!0?5e3:e.autoClose,"ms"),animationPlayState:e.isRunning?"running":"paused",opacity:e.hide||e.autoClose===!1?0:1,transform:e.controlledProgress?"scaleX(".concat(e.progress,")"):"none"})),a=C(()=>["".concat(p.CSS_NAMESPACE,"__progress-bar"),e.controlledProgress?"".concat(p.CSS_NAMESPACE,"__progress-bar--controlled"):"".concat(p.CSS_NAMESPACE,"__progress-bar--animated"),"".concat(p.CSS_NAMESPACE,"__progress-bar-theme--").concat(e.theme),"".concat(p.CSS_NAMESPACE,"__progress-bar--").concat(e.type),e.rtl?"".concat(p.CSS_NAMESPACE,"__progress-bar--rtl"):null].filter(Boolean).join(" ")),i=C(()=>"".concat(a.value," ").concat((t==null?void 0:t.class)||"")),c=()=>{n.value&&(n.value.onanimationend=null,n.value.ontransitionend=null)},l=()=>{e.isIn&&e.closeToast&&e.autoClose!==!1&&(e.closeToast(),c())},s=C(()=>e.controlledProgress?null:l),u=C(()=>e.controlledProgress?l:null);return Y(()=>{n.value&&(c(),n.value.onanimationend=s.value,n.value.ontransitionend=u.value)}),()=>g("div",{ref:n,role:"progressbar","aria-hidden":r.value,"aria-label":"notification timer",class:i.value,style:o.value},null)}}),ht=ne({name:"CloseButton",inheritAttrs:!1,props:{theme:{type:String,required:!1,default:k.AUTO},type:{type:String,required:!1,default:k.LIGHT},ariaLabel:{type:String,required:!1,default:"close"},closeToast:{type:Function,required:!1,default:void 0}},setup(e){return()=>g("button",{class:"".concat(p.CSS_NAMESPACE,"__close-button ").concat(p.CSS_NAMESPACE,"__close-button--").concat(e.theme),type:"button",onClick:t=>{t.stopPropagation(),e.closeToast&&e.closeToast(t)},"aria-label":e.ariaLabel},[g("svg",{"aria-hidden":"true",viewBox:"0 0 14 16"},[g("path",{"fill-rule":"evenodd",d:"M7.71 8.23l3.75 3.75-1.48 1.48-3.75-3.75-3.75 3.75L1 11.98l3.75-3.75L1 4.48 2.48 3l3.75 3.75L9.98 3l1.48 1.48-3.75 3.75z"},null)])])}}),ae=({theme:e,type:t,path:n,...r})=>g("svg",M({viewBox:"0 0 24 24",width:"100%",height:"100%",fill:e==="colored"?"currentColor":"var(--toastify-icon-color-".concat(t,")")},r),[g("path",{d:n},null)]);function gt(e){return g(ae,M(e,{path:"M23.32 17.191L15.438 2.184C14.728.833 13.416 0 11.996 0c-1.42 0-2.733.833-3.443 2.184L.533 17.448a4.744 4.744 0 000 4.368C1.243 23.167 2.555 24 3.975 24h16.05C22.22 24 24 22.044 24 19.632c0-.904-.251-1.746-.68-2.44zm-9.622 1.46c0 1.033-.724 1.823-1.698 1.823s-1.698-.79-1.698-1.822v-.043c0-1.028.724-1.822 1.698-1.822s1.698.79 1.698 1.822v.043zm.039-12.285l-.84 8.06c-.057.581-.408.943-.897.943-.49 0-.84-.367-.896-.942l-.84-8.065c-.057-.624.25-1.095.779-1.095h1.91c.528.005.84.476.784 1.1z"}),null)}function St(e){return g(ae,M(e,{path:"M12 0a12 12 0 1012 12A12.013 12.013 0 0012 0zm.25 5a1.5 1.5 0 11-1.5 1.5 1.5 1.5 0 011.5-1.5zm2.25 13.5h-4a1 1 0 010-2h.75a.25.25 0 00.25-.25v-4.5a.25.25 0 00-.25-.25h-.75a1 1 0 010-2h1a2 2 0 012 2v4.75a.25.25 0 00.25.25h.75a1 1 0 110 2z"}),null)}function Et(e){return g(ae,M(e,{path:"M12 0a12 12 0 1012 12A12.014 12.014 0 0012 0zm6.927 8.2l-6.845 9.289a1.011 1.011 0 01-1.43.188l-4.888-3.908a1 1 0 111.25-1.562l4.076 3.261 6.227-8.451a1 1 0 111.61 1.183z"}),null)}function bt(e){return g(ae,M(e,{path:"M11.983 0a12.206 12.206 0 00-8.51 3.653A11.8 11.8 0 000 12.207 11.779 11.779 0 0011.8 24h.214A12.111 12.111 0 0024 11.791 11.766 11.766 0 0011.983 0zM10.5 16.542a1.476 1.476 0 011.449-1.53h.027a1.527 1.527 0 011.523 1.47 1.475 1.475 0 01-1.449 1.53h-.027a1.529 1.529 0 01-1.523-1.47zM11 12.5v-6a1 1 0 012 0v6a1 1 0 11-2 0z"}),null)}function Ct(){return g("div",{class:"".concat(p.CSS_NAMESPACE,"__spinner")},null)}const ve={info:St,warning:gt,success:Et,error:bt,spinner:Ct},At=e=>e in ve;function Nt({theme:e,type:t,isLoading:n,icon:r}){let o;const a={theme:e,type:t};return n?o=ve.spinner():r===!1?o=void 0:J(r)?o=P(r):H(r)?o=r(a):Oe(r)?o=Ge(r,a):ye(r)||dt(r)?o=r:At(t)&&(o=ve[t](a)),o}const Ot=()=>{};function Tt(e,t,n=p.COLLAPSE_DURATION){const{scrollHeight:r,style:o}=e,a=n;requestAnimationFrame(()=>{o.minHeight="initial",o.height=r+"px",o.transition="all ".concat(a,"ms"),requestAnimationFrame(()=>{o.height="0",o.padding="0",o.margin="0",setTimeout(t,a)})})}function _t(e){const t=U(!1),n=U(!1),r=U(!1),o=U(ee.Enter),a=Q({...e,appendPosition:e.appendPosition||!1,collapse:typeof e.collapse>"u"?!0:e.collapse,collapseDuration:e.collapseDuration||p.COLLAPSE_DURATION}),i=a.done||Ot,c=C(()=>a.appendPosition?"".concat(a.enter,"--").concat(a.position):a.enter),l=C(()=>a.appendPosition?"".concat(a.exit,"--").concat(a.position):a.exit),s=C(()=>e.pauseOnHover?{onMouseenter:I,onMouseleave:d}:{});function u(){const A=c.value.split(" ");f().addEventListener(de.ENTRANCE_ANIMATION_END,d,{once:!0});const O=_=>{const B=f();_.target===B&&(B.dispatchEvent(new Event(de.ENTRANCE_ANIMATION_END)),B.removeEventListener("animationend",O),B.removeEventListener("animationcancel",O),o.value===ee.Enter&&_.type!=="animationcancel"&&B.classList.remove(...A))},T=()=>{const _=f();_.classList.add(...A),_.addEventListener("animationend",O),_.addEventListener("animationcancel",O)};e.pauseOnFocusLoss&&h(),T()}function v(){if(!f())return;const A=()=>{const T=f();T.removeEventListener("animationend",A),a.collapse?Tt(T,i,a.collapseDuration):i()},O=()=>{const T=f();o.value=ee.Exit,T&&(T.className+=" ".concat(l.value),T.addEventListener("animationend",A))};n.value||(r.value?A():setTimeout(O))}function f(){return e.toastRef.value}function h(){document.hasFocus()||I(),window.addEventListener("focus",d),window.addEventListener("blur",I)}function m(){window.removeEventListener("focus",d),window.removeEventListener("blur",I)}function d(){(!e.loading.value||e.isLoading===void 0)&&(t.value=!0)}function I(){t.value=!1}function F(A){A&&(A.stopPropagation(),A.preventDefault()),n.value=!1}return Y(v),Y(()=>{const A=W();n.value=A.findIndex(O=>O.toastId===a.toastId)>-1}),Y(()=>{e.isLoading!==void 0&&(e.loading.value?I():d())}),Te(u),_e(()=>{e.pauseOnFocusLoss&&m()}),{isIn:n,isRunning:t,hideToast:F,eventHandlers:s}}const It=ne({name:"ToastItem",inheritAttrs:!1,props:Be,setup(e){const t=U(),n=C(()=>!!e.isLoading),r=C(()=>e.progress!==void 0&&e.progress!==null),o=C(()=>Nt(e)),a=C(()=>["".concat(p.CSS_NAMESPACE,"__toast"),"".concat(p.CSS_NAMESPACE,"__toast-theme--").concat(e.theme),"".concat(p.CSS_NAMESPACE,"__toast--").concat(e.type),e.rtl?"".concat(p.CSS_NAMESPACE,"__toast--rtl"):void 0,e.toastClassName||""].filter(Boolean).join(" ")),{isRunning:i,isIn:c,hideToast:l,eventHandlers:s}=_t({toastRef:t,loading:n,done:()=>{w.remove(e.toastId)},...Le(e.transition),...e});return()=>g("div",M({id:e.toastId,class:a.value,style:e.toastStyle||{},ref:t,"data-testid":"toast-item-".concat(e.toastId),onClick:u=>{e.closeOnClick&&l(),e.onClick&&e.onClick(u)}},s.value),[g("div",{role:e.role,"data-testid":"toast-body",class:"".concat(p.CSS_NAMESPACE,"__toast-body ").concat(e.bodyClassName||"")},[o.value!=null&&g("div",{"data-testid":"toast-icon-".concat(e.type),class:["".concat(p.CSS_NAMESPACE,"__toast-icon"),e.isLoading?"":"".concat(p.CSS_NAMESPACE,"--animate-icon ").concat(p.CSS_NAMESPACE,"__zoom-enter")].join(" ")},[J(o.value)?X(P(o.value),{theme:e.theme,type:e.type}):H(o.value)?o.value({theme:e.theme,type:e.type}):o.value]),g("div",{"data-testid":"toast-content"},[J(e.content)?X(P(e.content),{toastProps:P(e),closeToast:l,data:e.data}):H(e.content)?e.content({toastProps:P(e),closeToast:l,data:e.data}):e.dangerouslyHTMLString?X("div",{innerHTML:e.content}):e.content])]),(e.closeButton===void 0||e.closeButton===!0)&&g(ht,{theme:e.theme,closeToast:u=>{u.stopPropagation(),u.preventDefault(),l()}},null),J(e.closeButton)?X(P(e.closeButton),{closeToast:l,type:e.type,theme:e.theme}):H(e.closeButton)?e.closeButton({closeToast:l,type:e.type,theme:e.theme}):null,g(vt,{className:e.progressClassName,style:e.progressStyle,rtl:e.rtl,theme:e.theme,isIn:c.value,type:e.type,hide:e.hideProgressBar,isRunning:i.value,autoClose:e.autoClose,controlledProgress:r.value,progress:e.progress,closeToast:e.isLoading?void 0:l},null)])}});let G=0;function Me(){typeof window>"u"||(G&&window.cancelAnimationFrame(G),G=window.requestAnimationFrame(Me),te.lastUrl!==window.location.href&&(te.lastUrl=window.location.href,w.clear()))}const Pt=ne({name:"ToastifyContainer",inheritAttrs:!1,props:Be,setup(e){const t=C(()=>e.containerId),n=C(()=>b[t.value]||[]),r=C(()=>n.value.filter(o=>o.position===e.position));return Te(()=>{typeof window<"u"&&e.clearOnUrlChange&&window.requestAnimationFrame(Me)}),_e(()=>{typeof window<"u"&&G&&(window.cancelAnimationFrame(G),te.lastUrl="")}),()=>g(Qe,null,[r.value.map(o=>{const{toastId:a=""}=o;return g(It,M({key:a},o),null)})])}});let se=!1;function De(){const e=[];return W().forEach(t=>{const n=document.getElementById(t.containerId);n&&!n.classList.contains(re)&&e.push(t)}),e}function Lt(e){const t=De().length,n=e??0;return n>0&&t+x.items.length>=n}function wt(e){Lt(e.limit)&&!e.updateId&&x.items.push({toastId:e.toastId,containerId:e.containerId,toastContent:e.content,toastProps:e})}function D(e,t,n={}){if(se)return;n=oe(pt(),{type:t},P(n)),(!n.toastId||typeof n.toastId!="string"&&typeof n.toastId!="number")&&(n.toastId=Fe()),n={...n,content:e,containerId:n.containerId||String(n.position)};const r=Number(n==null?void 0:n.progress);return r<0&&(n.progress=0),r>1&&(n.progress=1),n.theme==="auto"&&(n.theme=mt()),wt(n),te.lastUrl=window.location.href,n.multiple?x.items.length?n.updateId&&Z(e,n):Z(e,n):(se=!0,y.clearAll(void 0,!1),setTimeout(()=>{Z(e,n)},0),setTimeout(()=>{se=!1},390)),n.toastId}const y=(e,t)=>D(e,N.DEFAULT,t);y.info=(e,t)=>D(e,N.DEFAULT,{...t,type:N.INFO});y.error=(e,t)=>D(e,N.DEFAULT,{...t,type:N.ERROR});y.warning=(e,t)=>D(e,N.DEFAULT,{...t,type:N.WARNING});y.warn=y.warning;y.success=(e,t)=>D(e,N.DEFAULT,{...t,type:N.SUCCESS});y.loading=(e,t)=>D(e,N.DEFAULT,oe(t,{isLoading:!0,autoClose:!1,closeOnClick:!1,closeButton:!1,draggable:!1}));y.dark=(e,t)=>D(e,N.DEFAULT,oe(t,{theme:k.DARK}));y.remove=e=>{e?w.dismiss(e):w.clear()};y.clearAll=(e,t)=>{w.clear(e,t)};y.isActive=e=>{let t=!1;return t=De().findIndex(n=>n.toastId===e)>-1,t};y.update=(e,t={})=>{setTimeout(()=>{const n=ut(e);if(n){const r=P(n),{content:o}=r,a={...r,...t,toastId:t.toastId||e,updateId:Fe()},i=a.render||o;delete a.render,D(i,a.type,a)}},0)};y.done=e=>{y.update(e,{isLoading:!1,progress:1})};y.promise=xt;function xt(e,{pending:t,error:n,success:r},o){var a,i,c;let l;const s={...o||{},autoClose:!1};t&&(l=ye(t)?y.loading(t,s):y.loading(t.render,{...s,...t}));const u={autoClose:(a=o==null?void 0:o.autoClose)!=null?a:!0,closeOnClick:(i=o==null?void 0:o.closeOnClick)!=null?i:!0,closeButton:(c=o==null?void 0:o.autoClose)!=null?c:null,isLoading:void 0,draggable:null,delay:100},v=(h,m,d)=>{if(m==null){y.remove(l);return}const I={type:h,...u,...o,data:d},F=ye(m)?{render:m}:m;return l?y.update(l,{...I,...F,isLoading:!1}):y(F.render,{...I,...F,isLoading:!1}),d},f=H(e)?e():e;return f.then(h=>{v("success",r,h)}).catch(h=>{v("error",n,h)}),f}y.POSITION=K;y.THEME=k;y.TYPE=N;y.TRANSITIONS=$e;const Ft={install(e,t={}){Bt(t)}};typeof window<"u"&&(window.Vue3Toastify=Ft);function Bt(e={}){const t=oe(Pe,e);ft(t)}var Mt=String.prototype.replace,Dt=/%20/g,ce={RFC1738:"RFC1738",RFC3986:"RFC3986"},qe={default:ce.RFC3986,formatters:{RFC1738:function(e){return Mt.call(e,Dt,"+")},RFC3986:function(e){return String(e)}},RFC1738:ce.RFC1738,RFC3986:ce.RFC3986},qt=qe,ue=Object.prototype.hasOwnProperty,j=Array.isArray,L=function(){for(var e=[],t=0;t<256;++t)e.push("%"+((t<16?"0":"")+t.toString(16)).toUpperCase());return e}(),jt=function(t){for(;t.length>1;){var n=t.pop(),r=n.obj[n.prop];if(j(r)){for(var o=[],a=0;a<r.length;++a)typeof r[a]<"u"&&o.push(r[a]);n.obj[n.prop]=o}}},je=function(t,n){for(var r=n&&n.plainObjects?Object.create(null):{},o=0;o<t.length;++o)typeof t[o]<"u"&&(r[o]=t[o]);return r},Rt=function e(t,n,r){if(!n)return t;if(typeof n!="object"){if(j(t))t.push(n);else if(t&&typeof t=="object")(r&&(r.plainObjects||r.allowPrototypes)||!ue.call(Object.prototype,n))&&(t[n]=!0);else return[t,n];return t}if(!t||typeof t!="object")return[t].concat(n);var o=t;return j(t)&&!j(n)&&(o=je(t,r)),j(t)&&j(n)?(n.forEach(function(a,i){if(ue.call(t,i)){var c=t[i];c&&typeof c=="object"&&a&&typeof a=="object"?t[i]=e(c,a,r):t.push(a)}else t[i]=a}),t):Object.keys(n).reduce(function(a,i){var c=n[i];return ue.call(a,i)?a[i]=e(a[i],c,r):a[i]=c,a},o)},Ut=function(t,n){return Object.keys(n).reduce(function(r,o){return r[o]=n[o],r},t)},Ht=function(e,t,n){var r=e.replace(/\+/g," ");if(n==="iso-8859-1")return r.replace(/%[0-9a-f]{2}/gi,unescape);try{return decodeURIComponent(r)}catch{return r}},kt=function(t,n,r,o,a){if(t.length===0)return t;var i=t;if(typeof t=="symbol"?i=Symbol.prototype.toString.call(t):typeof t!="string"&&(i=String(t)),r==="iso-8859-1")return escape(i).replace(/%u[0-9a-f]{4}/gi,function(u){return"%26%23"+parseInt(u.slice(2),16)+"%3B"});for(var c="",l=0;l<i.length;++l){var s=i.charCodeAt(l);if(s===45||s===46||s===95||s===126||s>=48&&s<=57||s>=65&&s<=90||s>=97&&s<=122||a===qt.RFC1738&&(s===40||s===41)){c+=i.charAt(l);continue}if(s<128){c=c+L[s];continue}if(s<2048){c=c+(L[192|s>>6]+L[128|s&63]);continue}if(s<55296||s>=57344){c=c+(L[224|s>>12]+L[128|s>>6&63]+L[128|s&63]);continue}l+=1,s=65536+((s&1023)<<10|i.charCodeAt(l)&1023),c+=L[240|s>>18]+L[128|s>>12&63]+L[128|s>>6&63]+L[128|s&63]}return c},zt=function(t){for(var n=[{obj:{o:t},prop:"o"}],r=[],o=0;o<n.length;++o)for(var a=n[o],i=a.obj[a.prop],c=Object.keys(i),l=0;l<c.length;++l){var s=c[l],u=i[s];typeof u=="object"&&u!==null&&r.indexOf(u)===-1&&(n.push({obj:i,prop:s}),r.push(u))}return jt(n),t},Qt=function(t){return Object.prototype.toString.call(t)==="[object RegExp]"},Gt=function(t){return!t||typeof t!="object"?!1:!!(t.constructor&&t.constructor.isBuffer&&t.constructor.isBuffer(t))},$t=function(t,n){return[].concat(t,n)},Vt=function(t,n){if(j(t)){for(var r=[],o=0;o<t.length;o+=1)r.push(n(t[o]));return r}return n(t)},Re={arrayToObject:je,assign:Ut,combine:$t,compact:zt,decode:Ht,encode:kt,isBuffer:Gt,isRegExp:Qt,maybeMap:Vt,merge:Rt},he=Re,$=qe,Kt=Object.prototype.hasOwnProperty,Ce={brackets:function(t){return t+"[]"},comma:"comma",indices:function(t,n){return t+"["+n+"]"},repeat:function(t){return t}},R=Array.isArray,Wt=String.prototype.split,Xt=Array.prototype.push,Ue=function(e,t){Xt.apply(e,R(t)?t:[t])},Yt=Date.prototype.toISOString,Ae=$.default,E={addQueryPrefix:!1,allowDots:!1,charset:"utf-8",charsetSentinel:!1,delimiter:"&",encode:!0,encoder:he.encode,encodeValuesOnly:!1,format:Ae,formatter:$.formatters[Ae],indices:!1,serializeDate:function(t){return Yt.call(t)},skipNulls:!1,strictNullHandling:!1},Zt=function(t){return typeof t=="string"||typeof t=="number"||typeof t=="boolean"||typeof t=="symbol"||typeof t=="bigint"},Jt=function e(t,n,r,o,a,i,c,l,s,u,v,f,h,m){var d=t;if(typeof c=="function"?d=c(n,d):d instanceof Date?d=u(d):r==="comma"&&R(d)&&(d=he.maybeMap(d,function(le){return le instanceof Date?u(le):le})),d===null){if(o)return i&&!h?i(n,E.encoder,m,"key",v):n;d=""}if(Zt(d)||he.isBuffer(d)){if(i){var I=h?n:i(n,E.encoder,m,"key",v);if(r==="comma"&&h){for(var F=Wt.call(String(d),","),A="",O=0;O<F.length;++O)A+=(O===0?"":",")+f(i(F[O],E.encoder,m,"value",v));return[f(I)+"="+A]}return[f(I)+"="+f(i(d,E.encoder,m,"value",v))]}return[f(n)+"="+f(String(d))]}var T=[];if(typeof d>"u")return T;var _;if(r==="comma"&&R(d))_=[{value:d.length>0?d.join(",")||null:void 0}];else if(R(c))_=c;else{var B=Object.keys(d);_=l?B.sort(l):B}for(var ie=0;ie<_.length;++ie){var q=_[ie],Ee=typeof q=="object"&&typeof q.value<"u"?q.value:d[q];if(!(a&&Ee===null)){var ke=R(d)?typeof r=="function"?r(n,q):n:n+(s?"."+q:"["+q+"]");Ue(T,e(Ee,ke,r,o,a,i,c,l,s,u,v,f,h,m))}}return T},en=function(t){if(!t)return E;if(t.encoder!==null&&typeof t.encoder<"u"&&typeof t.encoder!="function")throw new TypeError("Encoder has to be a function.");var n=t.charset||E.charset;if(typeof t.charset<"u"&&t.charset!=="utf-8"&&t.charset!=="iso-8859-1")throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");var r=$.default;if(typeof t.format<"u"){if(!Kt.call($.formatters,t.format))throw new TypeError("Unknown format option provided.");r=t.format}var o=$.formatters[r],a=E.filter;return(typeof t.filter=="function"||R(t.filter))&&(a=t.filter),{addQueryPrefix:typeof t.addQueryPrefix=="boolean"?t.addQueryPrefix:E.addQueryPrefix,allowDots:typeof t.allowDots>"u"?E.allowDots:!!t.allowDots,charset:n,charsetSentinel:typeof t.charsetSentinel=="boolean"?t.charsetSentinel:E.charsetSentinel,delimiter:typeof t.delimiter>"u"?E.delimiter:t.delimiter,encode:typeof t.encode=="boolean"?t.encode:E.encode,encoder:typeof t.encoder=="function"?t.encoder:E.encoder,encodeValuesOnly:typeof t.encodeValuesOnly=="boolean"?t.encodeValuesOnly:E.encodeValuesOnly,filter:a,format:r,formatter:o,serializeDate:typeof t.serializeDate=="function"?t.serializeDate:E.serializeDate,skipNulls:typeof t.skipNulls=="boolean"?t.skipNulls:E.skipNulls,sort:typeof t.sort=="function"?t.sort:null,strictNullHandling:typeof t.strictNullHandling=="boolean"?t.strictNullHandling:E.strictNullHandling}},dn=function(e,t){var n=e,r=en(t),o,a;typeof r.filter=="function"?(a=r.filter,n=a("",n)):R(r.filter)&&(a=r.filter,o=a);var i=[];if(typeof n!="object"||n===null)return"";var c;t&&t.arrayFormat in Ce?c=t.arrayFormat:t&&"indices"in t?c=t.indices?"indices":"repeat":c="indices";var l=Ce[c];o||(o=Object.keys(n)),r.sort&&o.sort(r.sort);for(var s=0;s<o.length;++s){var u=o[s];r.skipNulls&&n[u]===null||Ue(i,Jt(n[u],u,l,r.strictNullHandling,r.skipNulls,r.encode?r.encoder:null,r.filter,r.sort,r.allowDots,r.serializeDate,r.format,r.formatter,r.encodeValuesOnly,r.charset))}var v=i.join(r.delimiter),f=r.addQueryPrefix===!0?"?":"";return r.charsetSentinel&&(r.charset==="iso-8859-1"?f+="utf8=%26%2310003%3B&":f+="utf8=%E2%9C%93&"),v.length>0?f+v:""},z=Re,ge=Object.prototype.hasOwnProperty,tn=Array.isArray,S={allowDots:!1,allowPrototypes:!1,arrayLimit:20,charset:"utf-8",charsetSentinel:!1,comma:!1,decoder:z.decode,delimiter:"&",depth:5,ignoreQueryPrefix:!1,interpretNumericEntities:!1,parameterLimit:1e3,parseArrays:!0,plainObjects:!1,strictNullHandling:!1},nn=function(e){return e.replace(/&#(\d+);/g,function(t,n){return String.fromCharCode(parseInt(n,10))})},He=function(e,t){return e&&typeof e=="string"&&t.comma&&e.indexOf(",")>-1?e.split(","):e},rn="utf8=%26%2310003%3B",on="utf8=%E2%9C%93",an=function(t,n){var r={},o=n.ignoreQueryPrefix?t.replace(/^\?/,""):t,a=n.parameterLimit===1/0?void 0:n.parameterLimit,i=o.split(n.delimiter,a),c=-1,l,s=n.charset;if(n.charsetSentinel)for(l=0;l<i.length;++l)i[l].indexOf("utf8=")===0&&(i[l]===on?s="utf-8":i[l]===rn&&(s="iso-8859-1"),c=l,l=i.length);for(l=0;l<i.length;++l)if(l!==c){var u=i[l],v=u.indexOf("]="),f=v===-1?u.indexOf("="):v+1,h,m;f===-1?(h=n.decoder(u,S.decoder,s,"key"),m=n.strictNullHandling?null:""):(h=n.decoder(u.slice(0,f),S.decoder,s,"key"),m=z.maybeMap(He(u.slice(f+1),n),function(d){return n.decoder(d,S.decoder,s,"value")})),m&&n.interpretNumericEntities&&s==="iso-8859-1"&&(m=nn(m)),u.indexOf("[]=")>-1&&(m=tn(m)?[m]:m),ge.call(r,h)?r[h]=z.combine(r[h],m):r[h]=m}return r},ln=function(e,t,n,r){for(var o=r?t:He(t,n),a=e.length-1;a>=0;--a){var i,c=e[a];if(c==="[]"&&n.parseArrays)i=[].concat(o);else{i=n.plainObjects?Object.create(null):{};var l=c.charAt(0)==="["&&c.charAt(c.length-1)==="]"?c.slice(1,-1):c,s=parseInt(l,10);!n.parseArrays&&l===""?i={0:o}:!isNaN(s)&&c!==l&&String(s)===l&&s>=0&&n.parseArrays&&s<=n.arrayLimit?(i=[],i[s]=o):l!=="__proto__"&&(i[l]=o)}o=i}return o},sn=function(t,n,r,o){if(t){var a=r.allowDots?t.replace(/\.([^.[]+)/g,"[$1]"):t,i=/(\[[^[\]]*])/,c=/(\[[^[\]]*])/g,l=r.depth>0&&i.exec(a),s=l?a.slice(0,l.index):a,u=[];if(s){if(!r.plainObjects&&ge.call(Object.prototype,s)&&!r.allowPrototypes)return;u.push(s)}for(var v=0;r.depth>0&&(l=c.exec(a))!==null&&v<r.depth;){if(v+=1,!r.plainObjects&&ge.call(Object.prototype,l[1].slice(1,-1))&&!r.allowPrototypes)return;u.push(l[1])}return l&&u.push("["+a.slice(l.index)+"]"),ln(u,n,r,o)}},cn=function(t){if(!t)return S;if(t.decoder!==null&&t.decoder!==void 0&&typeof t.decoder!="function")throw new TypeError("Decoder has to be a function.");if(typeof t.charset<"u"&&t.charset!=="utf-8"&&t.charset!=="iso-8859-1")throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");var n=typeof t.charset>"u"?S.charset:t.charset;return{allowDots:typeof t.allowDots>"u"?S.allowDots:!!t.allowDots,allowPrototypes:typeof t.allowPrototypes=="boolean"?t.allowPrototypes:S.allowPrototypes,arrayLimit:typeof t.arrayLimit=="number"?t.arrayLimit:S.arrayLimit,charset:n,charsetSentinel:typeof t.charsetSentinel=="boolean"?t.charsetSentinel:S.charsetSentinel,comma:typeof t.comma=="boolean"?t.comma:S.comma,decoder:typeof t.decoder=="function"?t.decoder:S.decoder,delimiter:typeof t.delimiter=="string"||z.isRegExp(t.delimiter)?t.delimiter:S.delimiter,depth:typeof t.depth=="number"||t.depth===!1?+t.depth:S.depth,ignoreQueryPrefix:t.ignoreQueryPrefix===!0,interpretNumericEntities:typeof t.interpretNumericEntities=="boolean"?t.interpretNumericEntities:S.interpretNumericEntities,parameterLimit:typeof t.parameterLimit=="number"?t.parameterLimit:S.parameterLimit,parseArrays:t.parseArrays!==!1,plainObjects:typeof t.plainObjects=="boolean"?t.plainObjects:S.plainObjects,strictNullHandling:typeof t.strictNullHandling=="boolean"?t.strictNullHandling:S.strictNullHandling}},fn=function(e,t){var n=cn(t);if(e===""||e===null||typeof e>"u")return n.plainObjects?Object.create(null):{};for(var r=typeof e=="string"?an(e,n):e,o=n.plainObjects?Object.create(null):{},a=Object.keys(r),i=0;i<a.length;++i){var c=a[i],l=sn(c,r[c],n,typeof e=="string");o=z.merge(o,l,n)}return z.compact(o)};export{qe as f,y as l,fn as p,dn as s};
