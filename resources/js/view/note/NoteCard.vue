<template>
    <div class="note-card -shadow -small">
        <template v-for="noteItem in noteData.items">
            <NoteItem :itemData="noteItem"></NoteItem>
        </template>

    </div>
</template>

<script>
 import NoteItem from "@/view/note/noteItems/NoteItem.vue";

 export default {
     name: 'NoteCard',
     components: {NoteItem},
     props: {
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

 }
</script>
