import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import axios from 'axios';
import swal from 'sweetalert';

const initialState = {
    cartItems: [],
    isUpdated: false,
    total: 0,
}

export const getCartItems = createAsyncThunk('cart/getCartItems',
    async (payload) => {
        const { data } = await axios.post('/api/cart', {}, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        })
        return data;
    });

export const updateCart = createAsyncThunk('cart/updateCart',
    async (payload) => {
       try {
            const { data } = await axios.post('/api/update-cart', payload.params, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        })
        return {
            data,
            params: payload.params
        };
       } catch (error) {
           console.log(error)
       }
    });

export const deleteCartItem = createAsyncThunk('cart/deleteCartItem',
    async (payload) => {
        const { data } = await axios.post('/api/delete-item-in-cart', payload.params, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        })
        return {
            data,
            params: payload.params
        };
    });

    export const softDeleteCartItem = createAsyncThunk('cart/softDeleteCartItem',
    async (payload) => {
        axios.post('/api/soft-delete-item-in-cart', payload.params, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        }).then(res)
        .catch(err => console.log(err))
    });

    export const restoreCartItem = createAsyncThunk('cart/restoreCartItem',
    async (payload) => {
        axios.post('/api/recover-item-in-cart', payload.params, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        }).then(res)
        .catch(err => console.log(err))
    });

export const addCartItem = createAsyncThunk('cart/addCartItem',
    async (payload) => {
        axios.post('/api/add-to-cart', payload.params, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        })
        .then(res => {
            swal(
                'Added to cart successfully!',
                `Bạn đã thêm "${payload.params.name}" vào giỏ hàng.`,
                'success'
            )
        }).catch(err => console.log(err))

    });

    export const deleteAllCartItem = createAsyncThunk('cart/deleteAllCartItem',
     (payload) => {
        axios.post('/api/empty-cart', {}, {
            headers: {
                Authorization: `Bearer ${payload.token}`
            }
        }).then(res)
        .catch(err => console.log(err))
        
    });

const cartSlice = createSlice({
    name: 'cartItems',
    initialState,
    reducers: {
        setTotal: (state, action) => {
            state.total = action.payload
        },
        setIsUpdate: (state, action) => {
            state.isUpdated = !state.isUpdated
        },
        getCartsIsNotDeletedItems: (state, action) => {
            const data = [];
            state.cartItems.map( cart => {
               if(cart.pivot.deleted_at == null) {
                   data.push(cart);
               }
            });
            state.cartItems = data;
        },
    },
    extraReducers: {
        [getCartItems.fulfilled]: (state, action) => {
            state.cartItems = action.payload
            state.isUpdated = false
        },
        [updateCart.fulfilled]: (state, action) => {
            const cartList = [...state.cartItems];
            for (let i = 0; i < cartList.length; i++) {
                if (cartList[i].id == action.payload.params.id_product) {
                    cartList[i].quantity = action.payload.params.quantity;
                }
            }
            state.cartItems = cartList
            state.isUpdated = true
        },
        [deleteCartItem.fulfilled]: (state, action) => {
            const cartList = [...state.cartItems];
            for (let i = 0; i < cartList.length; i++) {
                if (cartList[i].id == action.payload.params.id_product) {
                    cartList.splice(i, 1);
                    break;
                }
            }
            state.cartItems = cartList
            state.isUpdated = true
        },
        [addCartItem.fulfilled]: (state, action) => {
            state.isUpdated = true
        },
    }
});

const { actions, reducer } = cartSlice;
export const { setIsUpdate, getCartsIsNotDeletedItems } = actions;
export default reducer;