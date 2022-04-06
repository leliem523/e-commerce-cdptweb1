import { createAsyncThunk, createSlice } from '@reduxjs/toolkit'
import axios from 'axios';
// import swal from 'sweetalert';

const initialState = {
    provinces: null,
    districts: null,
    wards: null,
    selected_province: -1,
    selected_district: -1,
    selected_ward: -1,
    btnTitle: 'Chọn địa điểm mua hàng',
    heading: {
        topHeading: 'Chọn tỉnh, thành phố',
        bottomHeading: '',
    },
}

export const getProvinces = createAsyncThunk('locations/getProvinces',
    async () => {
        try {
            const { data } = await axios.get(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province`, {
                withCredentials: false,
                headers: {
                    'token': '77ce42ac-58a0-11ec-ac64-422c37c6de1b',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            })
            return data;
        } catch (error) {
            swal({
                title: 'Lỗi gọi API',
                text: 'Không thể lấy dữ liệu Tỉnh/Thành (provinces)',
                icon: "error",
                button: "Ok!",
            });
            return [];
        }
    });

export const getDistricts = createAsyncThunk('locations/getDistricts',
    async () => {
        try {
            const { data } = await axios.get(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district`, {
                headers: {
                    'token': '77ce42ac-58a0-11ec-ac64-422c37c6de1b',
                },
            })
            return data;
        } catch (error) {
            return [];
        }
    });

export const getDistricts_ByProvinceID = createAsyncThunk('locations/getDistricts_ByProvinceID',
    async (payload) => {
        try {
            const { data } = await axios.post(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district`, payload.params, {
                headers: {
                    'token': '77ce42ac-58a0-11ec-ac64-422c37c6de1b',
                },
            })
            return data;
        } catch (error) {
            return [];
        }
    });

export const getWards_ByDistrictID = createAsyncThunk('locations/getWards_ByDistrictID',
    async (payload) => {
        try {
            const { data } = await axios.post(`https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward`, payload.params, {
                headers: {
                    'token': '77ce42ac-58a0-11ec-ac64-422c37c6de1b',
                }
            })
            return data;
        } catch (error) {
            return [];
        }
    });

const locationsSlice = createSlice({
    name: 'locations',
    initialState,
    reducers: {
        setSelected_province: (state, action) => {
            state.selected_province = action.payload;
        },
        setSelected_district: (state, action) => {
            state.selected_district = action.payload;
        },
        setSelected_ward: (state, action) => {
            state.selected_ward = action.payload;
        },
        setBtnTitle: (state, action) => {
            state.btnTitle = action.payload;
        },
        setHeading: (state, action) => {
            state.heading.topHeading = action.payload.topHeading;
            state.heading.bottomHeading = action.payload.bottomHeading;
        },
        removeLastSelectedItem: (state) => {
            if (state.selected_ward !== -1 || state.wards !== null) {
                state.wards = null;
                state.selected_ward = -1;
                state.selected_district = -1;
            }
            else if (state.selected_district !== -1 || state.districts !== null) {
                state.districts = null;
                state.selected_district = -1;
                state.selected_province = -1;
            }
        }
    },
    extraReducers: {
        [getProvinces.fulfilled]: (state, action) => {
            state.provinces = action.payload
        },
        [getDistricts.fulfilled]: (state, action) => {
            state.districts = action.payload
        },
        [getDistricts_ByProvinceID.fulfilled]: (state, action) => {
            state.districts = action.payload
        },
        [getWards_ByDistrictID.fulfilled]: (state, action) => {
            state.wards = action.payload
        },
    }
});

const { actions, reducer } = locationsSlice;
export const {
    setSelected_province,
    setSelected_district,
    setSelected_ward,
    setBtnTitle,
    setHeading,
    removeLastSelectedItem,

} = actions;
export default reducer;