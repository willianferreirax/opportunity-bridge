import{r as i,T as _,o as y,c as w,w as e,f as s,a as c,b as t,u as a,q as h,n as k}from"./app-a6b8c3ba.js";import{_ as v}from"./Modal-da527dda.js";import{_ as m}from"./DangerButton-d6c18708.js";import{_ as x}from"./DialogModal-9ee847ad.js";import{_ as g,a as C}from"./TextInput-b9c69344.js";import{_ as D}from"./SecondaryButton-d0f18529.js";import"./SectionTitle-d51914e0.js";import"./_plugin-vue_export-helper-c27b6911.js";const b=c("div",{class:"max-w-xl text-sm text-gray-600 dark:text-gray-400"}," Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. ",-1),V={class:"mt-5"},$={class:"mt-4"},S={__name:"DeleteUserForm",setup(A){const r=i(!1),l=i(null),o=_({password:""}),p=()=>{r.value=!0,setTimeout(()=>l.value.focus(),250)},u=()=>{o.delete(route("current-user.destroy"),{preserveScroll:!0,onSuccess:()=>n(),onError:()=>l.value.focus(),onFinish:()=>o.reset()})},n=()=>{r.value=!1,o.reset()};return(U,d)=>(y(),w(v,null,{title:e(()=>[s(" Delete Account ")]),description:e(()=>[s(" Permanently delete your account. ")]),content:e(()=>[b,c("div",V,[t(m,{onClick:p},{default:e(()=>[s(" Delete Account ")]),_:1})]),t(x,{show:r.value,onClose:n},{title:e(()=>[s(" Delete Account ")]),content:e(()=>[s(" Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. "),c("div",$,[t(g,{ref_key:"passwordInput",ref:l,modelValue:a(o).password,"onUpdate:modelValue":d[0]||(d[0]=f=>a(o).password=f),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",autocomplete:"current-password",onKeyup:h(u,["enter"])},null,8,["modelValue","onKeyup"]),t(C,{message:a(o).errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[t(D,{onClick:n},{default:e(()=>[s(" Cancel ")]),_:1}),t(m,{class:k(["ml-3",{"opacity-25":a(o).processing}]),disabled:a(o).processing,onClick:u},{default:e(()=>[s(" Delete Account ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]),_:1}))}};export{S as default};
