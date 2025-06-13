<template>
    <div :class="editStateClass(editIsStart)" v-if="isEdit" :ref="'note_card_' + itemData.id">
        <div :class="classes" v-if="editIsStart">
            <p ref='itemContent' contenteditable="true" style="border: none; outline: none;" >
                {{itemData.content ?? 'Начните писать здесь...'}}
            </p>
        </div>
        <p :class="classes" v-else v-html="itemData.content"  @click="editStart" @focusout="editEnd()"></p>
    </div>

    <div class="note-item" v-else>
        <p :class="classes" v-html="itemData.content"></p>
    </div>
</template>

<script>
import {useEditorStore} from "@/store/editor.js";
import {mapStores} from "pinia";
import {useCardsStore} from "@/store/cards.js";
import {onClickOutside} from '@vueuse/core'

const editorStore = useEditorStore();
export default {
    name: 'TextItem',
    data() {
        return {

        };
    },

    props: {
        isEdit: {
            required: false,
            type: Boolean
        },
        itemData: {
            required: true,
            type: Object
        },
        classes: {
            required: false,
            type: String
        }
    },
    methods: {
        editStart() {
            console.log('itemData', this.itemData)

            editorStore.editBlockId = this.itemData.id;
            editorStore.showBlockEditMenu();

            this.unsetEditorIdCardHandler();
        },
        editEnd() {
            console.log('editEnd()');
            editorStore.editBlockId = null;
            this.saveData();
        },
        saveData() {
            //Вынести в метод
            this.itemData.content = this.$refs.itemContent.innerText;
        },
        unsetEditorIdCardHandler() {
            let name = 'note_card_' + this.itemData.id;
            const target =  this.$refs[name];

            onClickOutside(target, (event)=> {
                if(this.itemData.id === editorStore.editBlockId) {
                    this.editEnd();
                }
            })


        },
        editStateClass(editIsStart) {
            return editIsStart ? '' : '-edit-ready';
        }
    },
    computed: {
        ...mapStores(useCardsStore, useEditorStore),
        editIsStart() {
            return this.itemData.id === editorStore.editBlockId;
        },

    },
    watch: {

    },
    mounted() {

    },
};
</script>

<style>

</style>
