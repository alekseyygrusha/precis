<template>
    <div class="demo-stand -sriracha-font">
        <div class="demo-block">
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <div class="text-description -gabriela-font">
                            <div class="heading">Создавайте и описывайте интересующую вас темамику.</div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="stand">
                            <div class="note-card -shadow -small">
                                <div class="note-item">
                                    <div class="heading-h1 px-4">Lorem ipsum dolor sit amet consectetur adipisicing.
                                        Non, sunt!
                                    </div>
                                </div>
                                <div class="note-item">
                                    <p class="px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum
                                        voluptates necessitatibus possimus. Lorem lorem
                                        <mark>ipsum dolor</mark>
                                        sit amet.
                                    </p>
                                </div>
                                <div class="note-item px-5">
                                    <p class="mb-2">Lorem ipsum dolor sit:</p>
                                    <ul>
                                        <li>Lorem, ipsum dolor.</li>
                                        <li>Lorem, ipsum.</li>
                                        <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
                                        <li>Lorem ipsum dolor sit amet consectetur.</li>
                                    </ul>
                                </div>
                                <div class="note-item px-4">
                                    <p>Lorem
                                        <mark>ipsum dolor</mark>
                                        sit amet, consectetur adipisicing elit. Excepturi sint eius voluptatem eos
                                        alias veniam deserunt hic, suscipit quaerat impedit quisquam rem libero aut.
                                    </p>
                                </div>
                                <div class="note-item px-4 font-style-italic fst-italic text-decoration-underline">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="px-4 card-number pb-4 text-end">1</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="demo-block -stand-left">
            <div class="container">
                <div class="row">
                    <div class="col-7">
                        <div class="stand">
                            <div class="note-card -shadow -small">
                                <div class="note-item heading-h1 px-4">
                                    <div>Setup Stores</div>
                                </div>
                                <div class="note-item px-4">
                                    <p>There is also another possible syntax to define stores. Similar to the Vue
                                        Composition API's setup function, we can pass in a function that defines
                                        reactive properties and methods and returns an object with the properties
                                        and methods we want to expose.</p>
                                </div>

                                <div class="note-item mb-3 px-4">
                                    <!-- <div class="code-editor1" v-html="this.code"></div> -->
                                    <div class="code-editor"></div>
                                </div>

                                <div class="note-item px-5">
                                    <p class="mb-2">In Setup Stores:</p>
                                    <ul>
                                        <li>
                                            <mark>ref()</mark>
                                            s become state properties
                                        </li>
                                        <li>
                                            <mark>computed()</mark>
                                            s become getters
                                        </li>
                                        <li>
                                            <mark>function()</mark>
                                            s become actions
                                        </li>
                                    </ul>
                                </div>
                                <div class="note-item px-4">
                                    <p>Setup stores bring a lot more flexibility than
                                        <mark>Option Stores</mark>
                                        as you can create watchers within a store and freely use any
                                        <mark>composable</mark>
                                        . However, keep in mind that using composables will get more complex when
                                        using SSR.
                                    </p>
                                </div>

                                <div class="px-4 pb-4 card-number text-end">1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="text-description -gabriela-font">
                            <div class="heading">Дополняйте свои мысли примерами кода, графиками или картинками.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="demo-block">
            <div class="container">
                <div class="row">
                    <div class="col-7">
                        <div class="text-description -gabriela-font">
                            <div class="heading">Добавляйте к карточкам контрольные вопросы.</div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="stand">
                            <QuestionItem></QuestionItem>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul style="margin-top: 200px;">
        <li>Создание самого блокнота. Название, заголовок, мб размер</li>
        <li>Создание листа. Заголовк, небольшой абзац, пару пунктов, небольшой абзац или вывод. Нумерация</li>
        <li>Создание листочка со вставкой кода, графика или мб какой-картинки. Так же абзац и ещё мб что</li>
        <li>Показать, что к карточке можно добавить блиц-вопрос. Сделать её может переворачиваемой. Подсказка после
            ответа юсера.
        </li>
        <li>В завершение можно написать какой-то текст кому это может быть полезно и, что создаваемыми досками можно
            делиться.
        </li>
    </ul>
</template>

<script>
import {EditorView, basicSetup} from "codemirror";
import {javascript} from "@codemirror/lang-javascript";
import {EditorState} from '@codemirror/state';
import {bespin} from 'thememirror';
import {useRootStore} from '@/store/root';
import {mapStores} from "pinia";
import {codeToHtml} from 'shiki'
import QuestionItem from "@/view/note/noteItems/QuestionItem.vue";
import HeaderComponent from "@/view/layout/Header.vue";

// доступ к переменной `store` в любом месте компонента ✨
// const store = useRootStore()

export default {
    data() {
        return {
            code: ''
        };
    },
    components: {
        HeaderComponent,
        QuestionItem
    },
    computed: {
        ...mapStores(useRootStore)
    },

    created() {
        console.log('created');
    },
    mounted() {
        console.log('mounted');
        this.initCodeItem('.code-editor')
    },
    methods: {
        async initCodeItem(selector) {
            let codeExample = `export const useCounterStore = defineStore('counter', {
  state: () => ({ count: 0, name: 'Eduardo' }),
  getters: {
    doubleCount: (state) => state.count * 2,
  },
  actions: {
    increment() {
      this.count++
    },
  },
})`;
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

}
</script>
