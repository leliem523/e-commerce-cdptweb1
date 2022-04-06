import { createAsyncThunk, createSlice } from "@reduxjs/toolkit"

const initialState = {
    categories: [],
}

export const getCategories = createAsyncThunk("categories/getCategories",
    async(token) => {
       const {data} = await axios.get('/api/categories', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        return data;
    }
)

export const categoriesSlice = createSlice({
    name: 'categories',
    initialState,
    extraReducers: {
        [getCategories.fulfilled]: (state, action) => {
            state.categories = action.payload
        }
    }
})

export default categoriesSlice.reducer