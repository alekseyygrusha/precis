<template>
        <div class="card-editor-menu">
            <transition-group name="fade">
                <div class="menu-wrap" v-if="editorStore.activeMenu === 'cardMenu'">
                    <div class="menu-item"  @click="showBlocksMenu">
                        <div class="icon">
                            <SvgIcon name="add"></SvgIcon>
                        </div>
                        <div class="annotation">Новый блок</div>
                    </div>
                    <div class="menu-item"  @click="deleteCard">
                        <div class="icon">
                            <SvgIcon name="delete"></SvgIcon>
                        </div>
                        <div class="annotation">Удалить</div>
                    </div>
                </div>

                <div class="menu-wrap" v-if="editorStore.activeMenu === 'blocksMenu'">
                    <div class="menu-item -visible" @click="goPrevMenu">
                        <div class="icon">
                            <SvgIcon name="back"></SvgIcon>
                        </div>
                        <div class="annotation ">Вернуться</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('heading')">
                        <div class="icon">
                            <SvgIcon name="heading"></SvgIcon>
                        </div>
                        <div class="annotation">Параграф</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('text')">
                        <div class="icon">
                            <SvgIcon name="text"></SvgIcon>
                        </div>
                        <div class="annotation">Параграф</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('list')">
                        <div class="icon">
                            <SvgIcon name="list2"></SvgIcon>
                        </div>
                        <div class="annotation">Список</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('code')">
                        <div class="icon">
                            <SvgIcon name="code2"></SvgIcon>
                        </div>
                        <div class="annotation">Код</div>
                    </div>
                </div>

                <div class="menu-wrap" v-if="editorStore.activeMenu === 'blockEditMenu'">
                    <div class="menu-item -visible" @click="showBlocksMenu">
                        <div class="icon">
                            <SvgIcon name="back"></SvgIcon>
                        </div>
                        <div class="annotation">Вернуться</div>
                    </div>
                    <div class="menu-item"  @click="deleteCard">
                        <div class="icon">
                            <SvgIcon name="delete"></SvgIcon>
                        </div>
                        <div class="annotation">Удалить</div>
                    </div>
                    <div class="menu-item">
                        <div class="icon">
                            <SvgIcon name="delete"></SvgIcon>
                        </div>
                        <div class="annotation">Выше</div>
                    </div>
                    <div class="menu-item">
                        <div class="icon">
                            <SvgIcon name="delete"></SvgIcon>
                        </div>
                        <div class="annotation">Ниже</div>
                    </div>
                </div>
            </transition-group>
        </div>
        <div class="note-card card-editor -shadow -small mb-4">
            <transition-group name="fade">
                <template v-for="noteItem in noteData.items" :key="noteItem.id">
                        <NoteItemEditor :itemData="noteItem" :cardId="id"  :noteId="noteItem.id" ></NoteItemEditor>
                </template>
            </transition-group>
            <div class="-sriracha-font px-4 card-number pb-4 text-end"></div>
        </div>


</template>

<script>
import NoteItem from "@/view/note/noteItems/NoteItem.vue";
import SvgIcon from "@/customElements/SvgIcon.vue";
import {useCardsStore} from "@/store/cards.js";
import {mapStores} from "pinia";
import NoteItemEditor from "@/view/note/noteItemsEditor/NoteItemEditor.vue";
import {useEditorStore} from "@/store/editor.js";

const cardsStore = useCardsStore();
const editorStore = useEditorStore();

const blockItems = cardsStore.blocks;
export default {
    name: 'CardEditor',
    components: {NoteItemEditor, SvgIcon, NoteItem},

    props: {
        id: {
            type: Number,
        },
        noteData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isShowBlocksMenu: false
        };
    },
    created() {
        console.log(editorStore.activeMenu)

    },
    methods: {
        addCardBlock(blockType) {
            let newBlock = Object.assign({}, blockItems[blockType]);
            let testId = cardsStore.idGlobalCounter;
            cardsStore.addBlockToCard(this.id, newBlock)
            console.log('newBlock', newBlock);
        },
        goPrevMenu() {
            editorStore.showCardMenu();
        },
        showBlocksMenu() {
            editorStore.showBlocksMenu();
        },
        deleteCard() {

        }
    },
    computed: {
        ...mapStores(useCardsStore, useEditorStore)
    }

}
</script>
