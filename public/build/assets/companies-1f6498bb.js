import{aB as t,az as z,bf as E,cr as r}from"./main-70b82271.js";import{l as c,a as n}from"./index-628b2924.js";function T(){const o=t(!1),l=t(null),P=t(null),u=z({}),p=t([]),i=t(10),d=t(0),m=t(1),v=t(1),x=[10,25,50,100],y=t(""),g=t("id"),f=t(!0),B=t(null),h=t({}),w=t({}),D=async a=>{try{o.value=!0;const e=await r.delete(c("companies.destroy",a));l.value=e,n.success(e.data.message)}catch(e){console.log(e),n.error("Error! Deleting user")}finally{o.value=!1}},L=async a=>{const e=await r.get(c("companies.show",a));h.value=e.data.data},b=async a=>await r.get(c("current-company")),I=async(a,e)=>{try{o.value=!0;const s=await r.post(c("companies.update",a),e);l.value=s,n.success(s.data.message)}catch(s){console.log(s),s.response.status===422&&(w.value=s.response.data.errors),n.error(s.response.data.message)}finally{o.value=!1}},R=async a=>{try{o.value=!0;const e=await r.post(c("companies.status",a.id),a);l.value=e,n.success(e.data.message)}catch(e){console.log(e),e.response.status===422&&n.error(e.response.data.message)}finally{o.value=!1}},S=async a=>{o.value=!0,await r.post(c("companies.store"),a).then(e=>{l.value=e,n.success(e.data.message)}).catch(e=>{l.value=e,e.response.status===422&&n.error(e.response.data.message)}).finally(()=>{o.value=!1})},C=async()=>{o.value=!0;try{const a=await r.get(c("companies.index"),{params:{q:y.value,perPage:i.value,page:m.value,sortBy:g.value,sortDesc:f.value,...u}}),{total:e,last_page:s}=a.data.meta;v.value=s,p.value=a.data.data,d.value=e}catch(a){n.error(a.response.data.message)}finally{o.value=!1}},q=async a=>{var e;o.value=!0;try{const s=await r.get(c("fetch-companies"),{params:{...u}});p.value=(e=s==null?void 0:s.data)==null?void 0:e.data}catch(s){console.log(s),n.error(s.response.data.message)}finally{o.value=!1}};return E([m,i,y,u],()=>{C()}),{user:h,isLoading:o,errors:w,getCompany:L,companyId:B,sortBy:g,perPage:i,totalPages:v,filters:u,currentCompany:b,respResult:l,companies:p,fetchCompanies:C,deleteCompany:D,updateCompany:I,currentPage:m,searchQuery:y,refListTable:P,totalRecords:d,isSortDirDesc:f,perPageOptions:x,storeCompany:S,fetchCompaniesList:q,updateCompanyStatus:R}}export{T as u};
