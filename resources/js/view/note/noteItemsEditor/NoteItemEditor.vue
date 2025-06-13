<template>
    <div class="note-item" :class="editorStore.editBlockId && editorStore.editBlockId !== itemData.id ? '-focus-out' : ''">
        <component :is="componentName" :isEdit="true" :noteId="noteId" :itemData="itemData" :classes="setClasses"></component>
    </div>
</template>

<script>
import HeadingItem from "@/view/note/noteItems/HeadingItem.vue";
import TextItem from "@/view/note/noteItems/TextItem.vue";
import ListItem from "@/view/note/noteItems/ListItem.vue";
import CodeExampleItem from "@/view/note/noteItems/CodeExampleItem.vue";
import {useEditorStore} from "@/store/editor.js";
import {mapStores} from "pinia";
import {useCardsStore} from "@/store/cards.js";

const editorStore = useEditorStore();
export default {
    name: 'NoteItemEditor',
    data() {
        return {

        };
    },
    components: {
        HeadingItem,TextItem, ListItem, CodeExampleItem
    },
    props: {
        noteId: {
            required: true,
            type: Number
        },
        itemData: {
            required: true,
            type: Object
        }
    },
    computed: {
        ...mapStores(useEditorStore),
        componentName() {
            return `${this.itemData.type.charAt(0).toUpperCase() + this.itemData.type.slice(1)}Item`
        },
        setClasses() {
            return this.itemData?.defaultClasses.join(" ") + ' ' + this.itemData?.classes.join(" ");
        }

    },
    watch: {

    },
    created() {

    },
    mounted() {

    },
};
</script>

<style>

</style>
