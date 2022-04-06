import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import axios from 'axios';
import swal from 'sweetalert';

const initialState = {
    products: [],
}


// Execute api
 export const getProducts = createAsyncThunk('products/getProducts', 
  async(token) => {
    const {data} = await axios.get('/api/products', {  
      headers: {
        Authorization: `Bearer ${token}`
      }})
    return data;
  })

  export const searchProducts = createAsyncThunk('products/searchProducts', 
  async(payload) => {
    try{
      const {data} = await axios.get(`/api/search/${payload.key}`, {  
        headers: {
          Authorization: `Bearer ${payload.token}`
        }})
        return data;
    }
    catch(err) {
      return []
    }
  })

  export const getProductsByCategory = createAsyncThunk('products/getProductsByCategory', 
  async(payload) => {
    const {data} = await axios.get(`/api/category/${btoa('111'.concat(payload.key))}`, {
      headers: {
          Authorization: `Bearer ${payload.token}`
      }
  })
    return data;
  })

  export const getProductBySlug = createAsyncThunk('products/getProductsBySlug',
    async(payload) => {
      const {data} = await axios.get(`/api/product/${payload.slug}`,  {
        headers: {
            Authorization: `Bearer ${payload.token}`
        }});
        return data;
    }
  )

  export const getProductsByRateRange = createAsyncThunk('products/getProductsByRateRange',
    async(payload) => {
    const {data} = await axios.post('/api/products/filter/rate', payload.params,  {
      headers: {
          Authorization: `Bearer ${payload.token}`
      }});
      return data;
  })

export const productsSlice = createSlice({
    name: 'products',
    initialState,
    reducers: {
      clearProducts: (state) => {
        state.products = []
      },
      // Price range sort func
      sortListByPrice_LowToHigh: (state) => {
        const newList = [...state.products];
        let temp;
        let isSorted = false;
        while (isSorted === false) {
          for (let i = 0; i < newList.length - 1; i++) {
            if (newList[i].price > newList[i + 1].price) {
              temp = newList[i];
              newList[i] = newList[i + 1];
              newList[i + 1] = temp;
              isSorted = true;
            }
          } 
          if (isSorted === false) {
            break;
          }
          else {
            isSorted = false;
          }
        }
        state.products = newList;
      },
      sortListByPrice_HighToLow: (state) => {
        const newList = [...state.products];
        let temp;
        let isSorted = false;
        while (isSorted === false) {
          for (let i = 0; i < newList.length - 1; i++) {
            if (newList[i].price < newList[i + 1].price) {
              temp = newList[i];
              newList[i] = newList[i + 1];
              newList[i + 1] = temp;
              isSorted = true;
            }
          }
          if (isSorted === false) {
            break;
          }
          else {
            isSorted = false;
          }
        }
        state.products = newList;
      },
      getListByPriceRange: (state, action) => {
        const newList = [];
        for (let i = 0; i < state.products.length; i++) {
          if (state.products[i].price >= action.payload.from && state.products[i].price <= action.payload.to) {
            newList.push(state.products[i]);
          }
        }
        state.products = newList;
      },
      // Rating range sort func
      sortListByRating_LowToHigh: (state) => {
        let newList = [...state.products];
        let temp;
        let isSorted = false;
        while (isSorted === false) {
          for (let i = 0; i < newList.length - 1; i++) {
            if (newList[i].rating_value > newList[i + 1].rating_value) {
              temp = newList[i];
              newList[i] = newList[i + 1];
              newList[i + 1] = temp;
              isSorted = true;
            }
          } 
          if (isSorted === false) {
            break;
          }
          else {
            isSorted = false;
          }
        }
        state.products = newList;
      },
      sortListByRating_HighToLow: (state) => {
        const newList = [...state.products];
        let temp;
        let isSorted = false;
        while (isSorted === false) {
          for (let i = 0; i < newList.length - 1; i++) {
            if (newList[i].rating_value < newList[i + 1].rating_value) {
              temp = newList[i];
              newList[i] = newList[i + 1];
              newList[i + 1] = temp;
              isSorted = true;
            }
          }
          if (isSorted === false) {
            break;
          }
          else {
            isSorted = false;
          }
        }
        state.products = newList;
      },
      getListByRatingRange: (state, action) => {
        const newList = [];
        for (let i = 0; i < state.products.length; i++) {
          if (state.products[i].rating_value >= action.payload.from && state.products[i].rating_value <= action.payload.to) {
            newList.push(state.products[i]);
          }
        }
        state.products = newList;
      },
    },
    extraReducers: {
      [getProducts.fulfilled] : (state, action) => {
        state.products = action.payload
      },
      [searchProducts.pending] : (state, action) => {
        state.products = [];
      },
      [searchProducts.fulfilled] : (state, action) => {
        state.products = action.payload
      },
      [getProductsByCategory.fulfilled] : (state, action) => {
        state.products = action.payload
      },
      [getProductsByRateRange.fulfilled] : (state, action) => {
        state.products = action.payload;
      }
    }
  })
  
  // Action creators are generated for each case reducer function
  export const { 
    clearProducts, 
    sortListByPrice_LowToHigh, 
    sortListByPrice_HighToLow, 
    getListByPriceRange,
    getListByRatingRange,
    sortListByRating_HighToLow,
    sortListByRating_LowToHigh, } = productsSlice.actions;
    
  export default productsSlice.reducer