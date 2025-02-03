<template>
    <div class="container">
        <div>
            <div class="cards-main-menu">
                <div class="menu">
                    <div class="menu-item" @click="makeNewNote()">Создать карточку</div>
                </div>
            </div>
            <div class="cards-book">
                <template v-for="(noteData, index) in this.cardsStore.cardsList">
                    <card-editor :noteData="noteData" :id="index"></card-editor>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import {useCardsStore} from "@/store/cards.js";
import {mapStores} from "pinia";
import CardEditor from "@/view/note/CardEditor.vue";
const cardsStore = useCardsStore();

console.log('cardsStore');
export default {
    name: 'Editor',
    components: {CardEditor},
    data() {
        return {};
    },
    mounted() {

    },
    methods: {
        makeNewNote() {
            cardsStore.makeNewCard();
        }
    },
    computed: {
        ...mapStores(useCardsStore)
    },
};
</script>

<style>

</style>
