<template>
    <div class="note-card -shadow -small mb-4">
        <template v-for="noteItem in noteData.items">
            <NoteItem :itemData="noteItem" :noteId="noteData.id"></NoteItem>
        </template>
        <div class="-sriracha-font px-4 card-number pb-4 text-end">{{noteNumber}}</div>
    </div>
</template>

<script>
 import NoteItem from "@/view/note/noteItems/NoteItem.vue";

 export default {
     name: 'NoteCard',
     components: {NoteItem},
     props: {
         noteNumber: {
             required: true,
             type: Number
         },
         noteData: {
             type: Object,
             required: true
         }
     },
     created() {
         console.log(this.noteData);
     },
     methods: {

     },
     computed: {
         calcCadsCount() {
             return Object.keys(this.noteData).length
         }
     }

 }
</script>
