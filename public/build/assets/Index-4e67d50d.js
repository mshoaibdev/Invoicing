import{_ as z}from"./ConfirmDialog-29549557.js";import{_ as F}from"./AppTextField-2e476594.js";import{aB as t,az as M,bf as E,cr as u,am as G,b0 as l,at as H,n as J,bk as y,y as d,bt as K,a5 as I,cc as W,q as k,aU as O,bu as X,o as Y}from"./main-70b82271.js";import{l as Z}from"./lodash-bc5bedbb.js";import{l as m,a as i}from"./index-628b2924.js";import{f as ee}from"./formatters-12413ec5.js";import{a as ae,V as Q}from"./VRow-498fad85.js";import{V as te}from"./VDataTableServer-09952818.js";import"./_commonjsHelpers-042e6b4d.js";import"./filter-73280f75.js";import"./VCheckboxBtn-d416ecdf.js";import"./VSelectionControl-f8a2bfe4.js";import"./VTable-163fc7a0.js";function se(){const s=t(!1),c=t(null),C=t(null),U=[{title:"#Transaction ID",key:"transaction_id",sortable:!1},{title:"Customer",key:"paymentable.customer.name",sortable:!1},{title:"Email",key:"paymentable.customer.email",sortable:!1},{title:"Amount",key:"amount",sortable:!1},{title:"Payment Date",key:"formattedPaymentDate",sortable:!1},{title:"Order Details",key:"order_details",sortable:!1},{title:"Actions",key:"actions",sortable:!1}],v=M({status:""}),g=t([]),b=t([]),P=t(10),B=t(0),p=t(1),_=t(1),N=[10,25,50,100],V=t(""),A=t("id"),h=t(!0),f=t(null),D=t({}),S=async e=>{try{s.value=!0;const a=await u.delete(m("payments.destroy",e));c.value=a,i.success(a.data.message)}catch(a){console.log(a),i.error("Error! Deleting payment")}finally{s.value=!1}},R=async e=>{const a=await u.get(m("payments.show",e));D.value=a.data.data},T=async(e,a)=>u.post(m("payments.send",e),a),q=async(e,a)=>{try{s.value=!0;const o=await u.post(m("payments.update",e),a);c.value=o,i.success(o.data.message)}catch(o){o.response.status===422&&(errors.value=o.response.data.errors),i.error(o.response.data.message)}finally{s.value=!1}},w=async(e,a)=>{try{s.value=!0;const o=await u.post(m("payments.status",e),a);c.value=o,i.success(o.data.message)}catch(o){console.log(o),o.response.status===422&&i.error(o.response.data.message)}finally{s.value=!1}},r=async e=>{s.value=!0,await u.post(m("payments.store"),e).then(a=>{c.value=a,i.success(a.data.message)}).catch(a=>{c.value=a,a.response.status===422&&i.error(a.response.data.message)}).finally(()=>{s.value=!1})},x=async()=>{s.value=!0;try{const e=await u.get(m("payments.index"),{params:{q:V.value,perPage:P.value,page:p.value,sortBy:A.value,sortDesc:h.value,...v}}),{total:a,last_page:o}=e.data.meta;_.value=o,g.value=e.data.data,B.value=a}catch(e){i.error(e.response.data.message)}finally{s.value=!1}},L=async()=>{s.value=!0;try{const e=await u.get(m("payments.count-by-status"));b.value=e.data.data}catch(e){i.error(e.response.data.message)}finally{s.value=!1}},n=async e=>{s.value=!0;try{const a=await u.get(m("payments.index"),{params:{...v}});g.value=a.data.data}catch(a){i.error(a.response.data.message)}finally{s.value=!1}},$=e=>e==="Paid"?{variant:"primary",icon:"tabler-circle-half-2"}:e==="Unpaid"?{variant:"warning",icon:"tabler-chart-pie"}:e==="Downloaded"?{variant:"info",icon:"tabler-arrow-down-circle"}:e==="Draft"?{variant:"secondary",icon:"tabler-device-floppy"}:e==="Sent"?{variant:"success",icon:"tabler-circle-check"}:e==="Overdue"?{variant:"error",icon:"tabler-alert-circle"}:{variant:"secondary",icon:"tabler-x"},j=Z.debounce(()=>{x()},500);return E(V,()=>{j()}),E([p,P,v],()=>{x()}),{paymentData:D,isLoading:s,getPayment:R,paymentId:f,sortBy:A,itemsPerPage:P,totalPages:_,filters:v,respResult:c,fetchPaymentsByStatus:L,payments:g,paymentsByStatus:b,fetchPayments:x,deletePayment:S,updatePayment:q,sendPayment:T,currentPage:p,searchQuery:V,refListTable:C,totalRecords:B,headers:U,isSortDirDesc:h,perPageOptions:N,storePayment:r,fetchPaymentsList:n,resolvePaymentstatusVariantAndIcon:$,updatePaymentstatus:w}}const ne=k("div",{class:"me-3 d-flex gap-3"},null,-1),oe={class:"d-flex align-center"},re={class:"me-3"},le={class:"d-flex align-center"},ie=["onClick"],Pe={__name:"Index",props:{customerId:{type:Number,required:!1}},setup(s){const c=s,{payments:C,totalRecords:U,isLoading:v,fetchPayments:g,currentPage:b,headers:P,deleteInvoice:B,itemsPerPage:p,searchQuery:_,paginationData:N,filters:V,resolvePaymentstatusVariantAndIcon:A}=se(),h=t([]),f=t(!1),D=t(!1);t(!1);const S=t(0),R=t(0);t({}),G(async()=>{c.customerId&&(R.value=c.customerId,V.customerId=c.customerId),await g()});const T=w=>{S.value=w,D.value=!0},q=async w=>{if(w===!1){f.value=!1;return}await B(S.value),f.value=!1,D.value=!1,await g()};return(w,r)=>{const x=F,L=z;return l(C)?(H(),J(X,{key:0,id:"invoice-list"},{default:y(()=>[d(K,{class:"d-flex align-center flex-wrap gap-4"},{default:y(()=>[d(ae,null,{default:y(()=>[d(Q,{lg:"3",md:"3",sm:"4",cols:"12"},{default:y(()=>[ne]),_:1}),d(Q,{offset:"6",lg:"3",md:"3",cols:"12",sm:"6"},{default:y(()=>[d(x,{modelValue:l(_),"onUpdate:modelValue":r[0]||(r[0]=n=>I(_)?_.value=n:null),label:"Search Payments",density:"compact"},null,8,["modelValue"])]),_:1})]),_:1})]),_:1}),d(W),d(l(te),{modelValue:l(h),"onUpdate:modelValue":r[1]||(r[1]=n=>I(h)?h.value=n:null),"items-per-page":l(p),"onUpdate:itemsPerPage":r[2]||(r[2]=n=>I(p)?p.value=n:null),page:l(b),"onUpdate:page":r[3]||(r[3]=n=>I(b)?b.value=n:null),loading:l(v),"items-length":l(U),headers:l(P),items:l(C),class:"text-no-wrap"},{"item.amount":y(({item:n})=>[k("div",oe,[k("span",re,O(l(ee)(n.raw.amount)),1)])]),"item.title":y(({item:n})=>[k("div",le,[k("a",{href:"javascript:;",onClick:$=>T(n.raw.id)},O(n.raw.title),9,ie)])]),_:1},8,["modelValue","items-per-page","page","loading","items-length","headers","items"]),d(L,{isDialogVisible:l(f),"onUpdate:isDialogVisible":r[4]||(r[4]=n=>I(f)?f.value=n:null),"cancel-title":"Cancelled","confirm-title":"Deleted","confirm-msg":"Invoice deleted successfully.","confirmation-question":"Are you sure you want to delete this invoice? This action cannot be undone.","cancel-msg":"Invoice deletion cancelled.",onConfirm:q},null,8,["isDialogVisible"])]),_:1})):Y("",!0)}}};export{Pe as default};
