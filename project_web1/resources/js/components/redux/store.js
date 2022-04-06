import { configureStore } from '@reduxjs/toolkit'
import productsReducer from './reducers/products'
import cartReducer from './reducers/cart'
import categoriesReducer from './reducers/categories'
import suggestionsReducer from './reducers/suggestions'
import productsByCategoryReducer from './reducers/productsByCategory'
import locationsReducer from './reducers/locations'

export default configureStore({
  reducer: {
    products: productsReducer,
    cart: cartReducer,
    categories: categoriesReducer,
    suggestions: suggestionsReducer,
    productsByCategory: productsByCategoryReducer,
    locations: locationsReducer,
  },
})