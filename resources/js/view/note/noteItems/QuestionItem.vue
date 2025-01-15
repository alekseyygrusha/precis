<template>
    <div class="note-card -small flip-container">
        <div class="questions-card -shadow  flip-card" :class="isToggle ? 'flipped' : ''">
            <div class="front-side pt-4">
                <div class="note-item-wrap h-100 pb-4">
                    <div class="note-item heading-h1 px-4">
                        <div>Хук жизненного цикла updated</div>
                    </div>

                    <div class="note-item px-4">
                        <p>DOM компонента уже будет обновлён к моменту вызова этого хука, поэтому здесь можно выполнять операции, связанные с DOM. Тем не менее, старайтесь избегать изменения состояния в этом хуке.</p>
                    </div>

                    <div class="note-item px-4">
                        <p>Обратите внимание: updated не гарантирует, что все дочерние компоненты также были отрисованы повторно. Если необходимо дождаться повторной отрисовки всех дочерних компонентов, можно воспользоваться vm.$nextTick внутри updated:</p>
                    </div>
                    <div class="note-item px-4">
                        <!-- <div class="code-editor1" v-html="this.code"></div> -->
                        <div class="code-editor mb-3" ref="codeEditor"></div>
                    </div>

                    <div class="note-item px-4">
                        <p>Обратите внимание: updated не гарантирует, что все дочерние компоненты также были отрисованы повторно. Если необходимо дождаться повторной отрисовки всех дочерних компонентов, можно воспользоваться vm.$nextTick внутри updated:</p>
                    </div>

                    <div class="buttons-bar mt-auto px-4">
                        <button class="btn -base" @click="toggleClass()">К вопросам</button>
                    </div>

                    <div class="px-4 card-number pb-4 text-end">1</div>
                </div>
            </div>

            <div class="back-side ">
                <div class="questions-block -gabriela-font">
                    <template v-for="(question, key) in questionsList">
                        <transition name="fade">
                            <div class="absolute-wap px-4" v-if="activeIndex == key">
                                <div class="quesion-text pt-4">{{question.question}}</div>
                                <div class="text-hint">
                                    <transition name="fade">
                                        <div v-if="questionHint">{{questionHint}}</div>
                                    </transition>
                                </div>

                                <div class="questions-list">
                                    <button class="btn question-item" :disabled="correctId && correctId !== item.id"  v-for="(item, itemKey) in question.items"  :key="item.id" :class="[item.id === errorId ? 'shake' : '', item.id === correctId ? '-success' : '']" @click="checkCorrectAnswer(item.id)" >{{ item.question }}</button>
                                </div>
                            </div>
                        </transition>
                    </template>
                    <transition name="fade" v-if="questionsCount">
                        <div class="questions-footer px-4">
                            <transition name="fade">
                                <div class="page-counter" v-if="!canEnd">
                                    <span>{{activeIndex + 1}}</span>/<span>{{ questionsCount }}</span>
                                </div>
                            </transition>
                            <div class="buttons-bar">
                                <button class="btn -base" v-if="!canEnd" @click="toggleClass()">Закрыть</button>
                                <button class="btn -base" v-if="!canEnd" :disabled="!correctId || activeIndex + 1 === questionsCount" @click="nextQuestion()">Следующий</button>
                                <button class="btn -base" v-if="canEnd" @click="endQuestions()">Завершить</button>
                            </div>
                        </div>
                    </transition>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import {EditorState} from "@codemirror/state";
    import {bespin} from "thememirror";
    import {basicSetup, EditorView} from "codemirror";
    import {javascript} from "@codemirror/lang-javascript";

    export default {
        name: 'QuestionItem',
        data() {
            return {
                errorId: '',
                correctId: false,
                activeIndex: 0,
                questionHint: '',
                questionsCount: 0,
                code: '',
                questionsList: {
                    0: {
                        question: 'что? где? когда??',

                        items: [
                            {
                                id: 1,
                                question: 'то, там, тогда',
                                hint: 'Верно!'
                            },
                            {
                                id: 2,
                                question: 'Вариант ответа 1',
                                hint: 'Ещё надо подумать 1'
                            },
                            {
                                id: 3,
                                question: 'Вариант ответа 2',
                                hint: 'Ещё надо подумать 2'
                            },
                            {
                                id: 4,
                                question: 'Вариант ответа 3',
                                hint: 'Ещё надо подумать 3'
                            }
                        ],
                        correct: 1
                    },
                    1: {
                        question: 'Какое из этих слов написано неверно?',
                        questionHint: '',
                        items: [
                            {
                                id: 1,
                                question: 'Полбанки',
                                hint: ''
                            },
                            {
                                id: 2,
                                question: 'Полбуханки',
                                hint: 'Ещё надо подумать 1'
                            },
                            {
                                id: 3,
                                question: 'Пол-литра',
                                hint: 'Ещё надо подумать 2'
                            },
                            {
                                id: 4,
                                question: 'Пол-чашки',
                                hint: 'Верно!'
                            }
                        ],
                        correct: 4
                    }
                },
                isToggle: false
            }
        },
        computed: {
            canEnd () {
                return this.correctId && this.activeIndex + 1 == this.questionsCount;
            }
        },
        mounted() {
            console.log(this.$refs);
            this.questionsCount = Object.keys(this.questionsList).length;

            this.initCodeItem(this.$refs.codeEditor)
        },

        methods: {
            async initCodeItem(selector) {

                this.code = `updated() {
  this.$nextTick(function () {
    // Код, который будет запущен только после
    // переотрисовки всех представлений
  })
}`;

                /*const html = await codeToHtml(this.code, {
                    lang: 'javascript',
                    theme: 'vitesse-dark'
                });
                this.code = html;*/


                const state = EditorState.create({
                    doc: this.code,
                    extensions: [
                        bespin, basicSetup, javascript(), EditorView.editable.of(false)
                    ]

                });


                const view = new EditorView({
                    parent: selector,
                    state
                })
            },
            toggleClass() {
                this.isToggle = !this.isToggle;
            },
            checkCorrectAnswer(id) {
                this.setBaseData();
                let isCorrect = this.questionsList[this.activeIndex].correct === id;
                let questionItem = this.questionsList[this.activeIndex].items.find(qi => qi.id === id);


                if(isCorrect) {
                    this.setCorrect(questionItem, id);
                } else {
                    this.setNotCorrect(questionItem, id);
                }

                this.questionHint = questionItem.hint;
            },
            setBaseData() {
                this.questionHint = false;
                this.errorId = false;
                this.correctId = false;
            },
            nextQuestion() {
                this.setBaseData();
                this.activeIndex = this.activeIndex + 1;
            },
            setCorrect(questionItem, id) {
                this.correctId = id;
            },
            setNotCorrect(questionItem, id) {
                this.errorId = id;
            },
            endQuestions() {
                this.toggleClass();
            }
        }
    }
</script>

