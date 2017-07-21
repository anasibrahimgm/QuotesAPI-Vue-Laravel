import Quotes from './components/Quotes.vue'
import newQuote from './components/newQuotes.vue'
import signUp from './components/signUp.vue'

export default [
  {path: '', component: Quotes},
  {path: '/new-quote', component: newQuote},
  {path: '/signUp', component: signUp},
]
