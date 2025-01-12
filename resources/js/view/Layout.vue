<template>
    <div>
        <header-component></header-component>
        <main class="pt-4">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
 import HeaderComponent from "@/view/layout/Header.vue";

 export default {
     name: 'Layout',
     components: {HeaderComponent}
 }
</script>
