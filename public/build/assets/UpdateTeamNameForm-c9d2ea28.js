import{T as f,o as _,c as p,G as g,w as t,b as m,f as n,u as o,n as h,a as s,t as l}from"./app-a6b8c3ba.js";import{_ as v}from"./ActionMessage-2ada17f3.js";import{_ as w}from"./FormSection-80e28bd9.js";import{_ as x,a as T}from"./TextInput-b9c69344.js";import{_ as c}from"./InputLabel-ac4d26cc.js";import{_ as b}from"./PrimaryButton-d317a559.js";import"./SectionTitle-d51914e0.js";import"./_plugin-vue_export-helper-c27b6911.js";const y={class:"col-span-6"},N={class:"flex items-center mt-2"},S=["src","alt"],k={class:"ml-4 leading-tight"},V={class:"text-gray-900 dark:text-white"},$={class:"text-gray-700 dark:text-gray-300 text-sm"},B={class:"col-span-6 sm:col-span-4"},A={__name:"UpdateTeamNameForm",props:{team:Object,permissions:Object},setup(e){const r=e,a=f({name:r.team.name}),d=()=>{a.put(route("teams.update",r.team),{errorBag:"updateTeamName",preserveScroll:!0})};return(U,i)=>(_(),p(w,{onSubmitted:d},g({title:t(()=>[n(" Team Name ")]),description:t(()=>[n(" The team's name and owner information. ")]),form:t(()=>[s("div",y,[m(c,{value:"Team Owner"}),s("div",N,[s("img",{class:"w-12 h-12 rounded-full object-cover",src:e.team.owner.profile_photo_url,alt:e.team.owner.name},null,8,S),s("div",k,[s("div",V,l(e.team.owner.name),1),s("div",$,l(e.team.owner.email),1)])])]),s("div",B,[m(c,{for:"name",value:"Team Name"}),m(x,{id:"name",modelValue:o(a).name,"onUpdate:modelValue":i[0]||(i[0]=u=>o(a).name=u),type:"text",class:"mt-1 block w-full",disabled:!e.permissions.canUpdateTeam},null,8,["modelValue","disabled"]),m(T,{message:o(a).errors.name,class:"mt-2"},null,8,["message"])])]),_:2},[e.permissions.canUpdateTeam?{name:"actions",fn:t(()=>[m(v,{on:o(a).recentlySuccessful,class:"mr-3"},{default:t(()=>[n(" Saved. ")]),_:1},8,["on"]),m(b,{class:h({"opacity-25":o(a).processing}),disabled:o(a).processing},{default:t(()=>[n(" Save ")]),_:1},8,["class","disabled"])]),key:"0"}:void 0]),1024))}};export{A as default};
