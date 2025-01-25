<template>
    <div :class="classes">
        <div class="code-editor" :id="getCodeExampleId"></div>
    </div>
</template>

<script>
import {codeToHtml} from "shiki";
import {EditorState} from "@codemirror/state";
import {bespin} from "thememirror";
import {basicSetup, EditorView} from "codemirror";
import {javascript} from "@codemirror/lang-javascript";
import noteItem from "@/view/note/noteItems/NoteItem.vue";

export default {
    name: 'CodeExampleItem',
    data() {
        return {};
    },
    props: {
        noteId: {
            required: true,
            type: Number
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

    mounted() {
        this.initCodeItem('.code-editor')
    },
    methods: {
        async initCodeItem(selector) {
            let codeExample = this.itemData.content;
            this.code = codeExample;

            const html = await codeToHtml(this.code, {
                lang: 'javascript',
                theme: 'vitesse-dark'
            });
            this.code = html;


            const state = EditorState.create({
                doc: codeExample,
                extensions: [
                    bespin, basicSetup, javascript(), EditorView.editable.of(false)
                ]

            });

            let codeEditor = document.querySelector(selector);

            const view = new EditorView({
                parent: codeEditor,
                state
            })
        }
    },
    computed: {
        getCodeExampleId () {
            return 'code-example-id-'+this.noteId+'-item-'+this.itemData.id;
        }
    },
};
</script>

<style>

</style>
