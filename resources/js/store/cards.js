import { defineStore } from 'pinia';


export const useCardsStore = defineStore('cards', {
    state: () => ({
        cardTemplate: {
            name: '',
            items: {},
            questions: {}
        },
        cardsList: [],
        blocks: {
            heading: {
                type: 'heading',
                content: 'Текст вашего заголовка',
                classes: ['heading-h1'],
                defaultClasses: ['px-4 -sriracha-font'] //будем только при создании их добавлять
            },
            text: {
                type: 'text',
                content: `Ваш текст`,
                classes: ['-sriracha-font'],
                defaultClasses: ['px-4']
            },
            list: {
                type: 'list',
                content: {
                    heading: `Lorem ipsum dolor sit:`,
                    list: {
                        0: 'Lorem, ipsum dolor.',
                        1: 'Lorem, ipsum.',
                        2: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
                        3: 'Lorem ipsum dolor sit amet consectetur.'
                    }
                },
                classes: ['-sriracha-font'],
                defaultClasses: ['px-5']
            }
        },
        dataCards: {
            0: {
                id: 1,
                name: '',
                items: {
                    0: {
                        id: 1,
                        type: 'heading',
                        content: 'Lorem ipsum dolor sit amet consectetur adipisicing. Non, sunt!',
                        classes: ['heading-h1 -sriracha-font'],
                        defaultClasses: ['px-4'] //будем только при создании их добавлять
                    },
                    1: {
                        id: 2,
                        type: 'text',
                        content: `Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum
                                voluptates necessitatibus possimus. Lorem lorem
                                <mark>ipsum dolor</mark>
                                sit amet.`,
                        classes: ['-sriracha-font'],
                        defaultClasses: ['px-4']
                    },
                    2: {
                        id: 3,
                        type: 'list',
                        content: {
                            heading: `Lorem ipsum dolor sit:`,
                            list: {
                                0: 'Lorem, ipsum dolor.',
                                1: 'Lorem, ipsum.',
                                2: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
                                3: 'Lorem ipsum dolor sit amet consectetur.'
                            }
                        },
                        classes: ['-sriracha-font'],
                        defaultClasses: ['px-5']
                    },
                    3: {
                        id: 4,
                        type: 'text',
                        content: `Lorem  <mark>ipsum dolor</mark> sit amet, consectetur adipisicing elit. Excepturi sint eius voluptatem eos alias veniam deserunt hic, suscipit quaerat impedit quisquam rem libero aut.`,
                        classes: ['-sriracha-font'],
                        defaultClasses: ['px-4']
                    },
                    4: {
                        id: 5,
                        type: 'text',
                        content: `Lorem ipsum dolor sit amet consectetur adipisicing elit.`,
                        classes: ['-sriracha-font font-style-italic fst-italic text-decoration-underline'],
                        defaultClasses: ['px-4']
                    },
                },
                questions: {}
            },
            1: {
                id: 2,
                name: '',
                items: {
                    0: {
                        id: 1,
                        type: 'heading',
                        content: 'Setup Stores',
                        classes: ['heading-h1 -sriracha-font'],
                        defaultClasses: ['px-4'] //будем только при создании их добавлять
                    },
                    1: {
                        id: 2,
                        type: 'text',
                        content: `There is also another possible syntax to define stores. Similar to the Vue Composition API's setup function, we can pass in a function that defines reactive properties and methods and returns an object with the properties and methods we want to expose.`,
                        classes: ['-sriracha-font'],
                        defaultClasses: ['px-4']
                    },
                    2: {
                        id: 2,
                        type: 'codeExample',
                        content: `export const useCounterStore = defineStore('counter', {
  state: () => ({ count: 0, name: 'Eduardo' }),
  getters: {
    doubleCount: (state) => state.count * 2,
  },
  actions: {
    increment() {
      this.count++
    },
  },
})\``,
                        classes: ['-sriracha-font mb-4'],
                        defaultClasses: ['px-4']
                    },
                    3: {
                        id: 3,
                        type: 'list',
                        content: {
                            heading: `In Setup Stores:`,
                            list: {
                                0: `<mark>ref()</mark> s become state properties`,
                                1: `<mark>computed()</mark> s become getters`,
                                2: `<mark>function()</mark> s become actions`
                            }
                        },
                        classes: ['-sriracha-font'],
                        defaultClasses: ['px-5']
                    },
                    4: {
                        id: 4,
                        type: 'text',
                        content: `Setup stores bring a lot more flexibility than <mark>Option Stores</mark> as you can create watchers within a store and freely use any composable . However, keep in mind that using <mark>composables</mark> will get more complex when using SSR.`,
                        classes: ['-sriracha-font'],
                        defaultClasses: ['px-4']
                    },

                },
                questions: {}
            },
        },
    }),
    actions: {
        makeNewCard() {
            this.cardsList.push(this.cardTemplate)
        },
        addBlockToCard(cardId, blockData) {
            //Исполнение на фронте. Надо будет думать про логику на бэке
            console.log('cardId', cardId);
            console.log('123', this.cardsList);
            let testId = Object.keys(this.cardsList[cardId].items).length ?? 1; //временный айдишник
            blockData.id = cardId;
            this.cardsList[cardId].items[testId] = blockData;
        }
    },
});
