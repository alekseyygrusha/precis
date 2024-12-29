<template>
    <div class="-sriracha-font">
        <header >
            <div class="container">
                <div class="wrap">
                    <div class="logo">
                        <img src="/images/icons/logo_header_2.png" alt="">
                    </div>
                    <div class="menu">
                        <div class="menu-item">Make a note</div>
                        <div class="menu-item">Note list</div>
                        <div class="menu-item">About us</div>
                        <div class="menu-item"></div>
                    </div>
                </div>

            </div>
        </header>
    </div>

</template>

<style lang="scss" >

</style>

<script setup>

import { useRootStore } from '@/store/root'

// доступ к переменной `store` в любом месте компонента ✨
const store = useRootStore()

</script>
