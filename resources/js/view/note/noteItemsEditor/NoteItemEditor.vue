<template>
    <div class="note-item" :class="editorStore.editBlockId && editorStore.editBlockId !== itemData.id ? '-focus-out' : ''">
        <component
            :is="componentName"
            :isEdit="true"
            :cardId="cardId"
            :noteId="noteId"
            :itemData="itemData"
            :classes="setClasses"
            @editStart="editStart"
            @editEnd="editEnd"
            @saveData="saveData">
        </component>
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
import {onClickOutside} from "@vueuse/core";

const editorStore = useEditorStore();
const cardsStore = useCardsStore();
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
        cardId: {
            required: true,
            type: Number
        },
        itemData: {
            required: true,
            type: Object
        }
    },
    methods: {
        editStart(itemId) {
            editorStore.startEditBlock(itemId);
            editorStore.showBlockEditMenu();
            /*this.unsetEditorIdCardHandler(itemId);*/
        },
        editEnd(data) {
            editorStore.showBlocksMenu();
            this.saveData(data);
        },
        saveData(data) {
            cardsStore.setItemContent(this.cardId, data.itemId, data.saveContent);
        },
        //TODO надо подумать как можно унифицировать этот метод чтобы исключить дублирование
        unsetEditorIdCardHandler(itemId, target, data) {
            onClickOutside(target, (event)=> {
                if(itemId === editorStore.editBlockId) {
                    this.editEnd(data); //как сюда data актуальную передавать? Брать по id из стора?
                }
            })
        },

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
