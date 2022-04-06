import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import axios from 'axios';

const initialState = {
    listOfProductLists: [],
    listOfCategoryNames: [],
}

export const getProductsByCategory = createAsyncThunk('productsByCategory/getProductsByCategory',
    async (payload) => {
        try {
            const { data } = await axios.get(`/api/category/${btoa('111'.concat(payload.key))}`, {
                headers: {
                    Authorization: `Bearer ${payload.token}`
                }
            })

            return data;
        } catch (error) {
            return [];
        }
    })

const productsByCategorySlice = createSlice({
    name: 'productsByCategory',
    initialState,
    reducers: {
        clearAll: (state) => {
            return {
                listOfProductLists: [],
                listOfCategoryNames: [],
            }
        },
        addNewProductList(state, action) {
            const newList = [...state.listOfProductLists];
            newList.push(action.payload);
            return {
                ...state,
                listOfProductLists: newList,
            }
        },
        addNewCategoryName(state, action) {
            const newList = [...state.listOfCategoryNames];
            newList.push(action.payload);
            return {
                ...state,
                listOfCategoryNames: newList,
            }
        },
    },
    extraReducers: { }
});

const { actions, reducer } = productsByCategorySlice;
export const { clearAll, addNewProductList, addNewCategoryName } = actions;
export default reducer;