import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import axios from 'axios';
// import swal from 'sweetalert';

const initialState = {
  searchSuggestions: [],
}

export const autocompleteSearch = createAsyncThunk('suggestions/autocompleteSearch',
  async (payload) => {
    try {
      const { data } = await axios.get(`/api/search/${payload.key}`, {
        headers: {
          Authorization: `Bearer ${payload.token}`
        }
      })
      return data;
    } catch (error) {
      return [];
    }
  })

const suggestionsSlice = createSlice({
  name: 'suggestions',
  initialState,
  reducers: {},
  extraReducers: {
    [autocompleteSearch.fulfilled]: (state, action) => {
      state.searchSuggestions = action.payload
    },
  }
});

const { actions, reducer } = suggestionsSlice;
export const { } = actions;
export default reducer;