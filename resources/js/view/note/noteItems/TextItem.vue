<template>
    <div :class="$editStateClass(editIsStart)" v-if="isEdit" :ref="'note_card_' + itemData.id">
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
const cardsStore = useCardsStore();
export default {
    name: 'TextItem',
    props: {
        isEdit: {
            required: false,
            type: Boolean
        },
        itemData: {
            required: true,
            type: Object
        },
        cardId: {
            required: true,
            type: Number
        },
        classes: {
            required: false,
            type: String
        },
        noteId: {
            required: true,
            type: Number
        },
    },
    methods: {
        editStart() {
            this.unsetEditorIdCardHandler();
            this.$emit('editStart', this.itemData.id);
        },
        editEnd() {
            this.$emit('editEnd', {
                saveContent: this.$refs.itemContent.innerText,
                itemId: this.itemData.id
            });
        },
        unsetEditorIdCardHandler() {
            let name = 'note_card_' + this.itemData.id;
            const target =  this.$refs[name];

            onClickOutside(target, (event)=> {
                if(this.itemData.id === editorStore.editBlockId) {
                    this.editEnd();
                }
            })
        }
    },
    computed: {
        ...mapStores(useCardsStore, useEditorStore),
        editIsStart() {
            return editorStore.isEditingBlock(this.itemData.id)
        }
    }
};
</script>

