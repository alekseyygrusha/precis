<template>
    <div class="container">
        <template v-for="(cardData, index) in cardsStore.$state.dataCards">
            <note-card :noteData="cardData" :noteNumber="parseInt(index) + 1"></note-card>
        </template>
    </div>
</template>

<script>
    import NoteCard from "@/view/note/NoteCard.vue";
    import {useCardsStore} from '@/store/cards';
    import {mapStores} from "pinia";
    const cardsStore = useCardsStore();
    console.log(cardsStore.$state);
    export default {
        name: 'Cards',
        data () {
            return {}
        },
        computed: {
            ...mapStores(useCardsStore)
        },

        components: {NoteCard}
    }
</script>
