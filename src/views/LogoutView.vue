<template>
   <BContainer fluid>
        <BRow class="align-items-center justify-content-center vh-100 text-center">
            <BCol>
                
    
            <BSpinner></BSpinner>

            <BSkeletonIcon class="h3">Logouting....</BSkeletonIcon>
        
          </BCol>
        </BRow>
    </BContainer>
  </template>
  
  <script setup>
  import { onMounted } from "vue";
  import { useLoginStore } from "@/stores/login.js";
  
  const { removeToken } = useLoginStore();
  
  onMounted(() => {
    setTimeout(function () {
      removeToken();
    }, 500);
  });
  </script>
  