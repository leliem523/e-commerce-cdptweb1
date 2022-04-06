import React, { useEffect, useState } from 'react';
import { LeftOutlined, CloseCircleOutlined } from '@ant-design/icons';

// Components:
import icon__location from '../assets/images/icons/icon__location.png';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import {
    getProvinces,
    getDistricts_ByProvinceID,
    getWards_ByDistrictID,
    setSelected_province,
    setSelected_district,
    setSelected_ward,
    setBtnTitle,
    setHeading,
    removeLastSelectedItem
} from '../redux/reducers/locations';

// CSS:
import '../assets/css/LocationBox.css';


function LocationBox(props) {

    // Redux:
    const {
        provinces,
        districts,
        wards,
        selected_province,
        selected_district,
        selected_ward,
        btnTitle,
        heading
    } = useSelector(state => state.locations);

    const dispatch = useDispatch();


    // Load data:
    useEffect(() => {
        if (provinces === null) {
            dispatch(getProvinces());
        }
    }, []);


    // Set heading for .location-btn__title:
    useEffect(() => {
        if (selected_province === -1) {
            dispatch(
                setHeading({
                    topHeading: 'Chọn tỉnh, thành phố',
                    bottomHeading: '',
                }));
            dispatch(setBtnTitle('Chọn địa điểm mua hàng'));
        }
        else if (selected_district === -1) {
            dispatch(
                setHeading({
                    topHeading: 'Chọn quận, huyện tại',
                    bottomHeading: selected_province.ProvinceName,
                }));
            dispatch(setBtnTitle(selected_province.ProvinceName));

        }
        else if (selected_ward === -1) {
            dispatch(
                setHeading({
                    topHeading: 'Chọn phường, xã tại',
                    bottomHeading: selected_district.DistrictName,
                }));
            dispatch(setBtnTitle(`${selected_province.ProvinceName}, ${selected_district.DistrictName}`));
        }
    }, [selected_province, selected_district, selected_ward]);


    // Methods:
    const handleOnclick_province = (province) => {
        dispatch(setSelected_province(province));
        dispatch(setBtnTitle(province.ProvinceName));
        dispatch(getDistricts_ByProvinceID({ params: { province_id: province.ProvinceID } }));
    }

    const handleOnclick_district = (district) => {
        dispatch(setSelected_district(district));
        dispatch(setBtnTitle(`${selected_province.ProvinceName}, ${district.DistrictName}`));
        dispatch(getWards_ByDistrictID({ params: { district_id: district.DistrictID } }));
    }

    const handleOnclick_ward = (ward) => {
        dispatch(setSelected_ward(ward));
        dispatch(setBtnTitle(`${selected_province.ProvinceName}, ${selected_district.DistrictName}, ${ward.WardName}`));
    }

    const handleOnclick_goBackBtn = () => {
        dispatch(removeLastSelectedItem());
    }

    // Component:
    const ListOfProvinces = () => {
        if (provinces.data !== null && provinces.data !== undefined) {
            return (
                provinces.data.map((element, index) => {
                    return (
                        <li
                            id={`province-${element.ProvinceID}`}
                            key={`location-${index}`}
                            className={`location-item${element.ProvinceID === selected_province.ProvinceID ? ' active' : ''}`}
                            onClick={() => handleOnclick_province(element)}
                        >
                            {element.ProvinceName}
                        </li>
                    );
                })
            );
        }
        else {
            return (
                <li>There are no lists to be displayed!</li>
            );
        }
    }

    const ListOfDistricts = () => {
        if (districts.data !== null && districts.data !== undefined) {
            return (
                districts.data.map((element, index) => {
                    return (
                        <li
                            id={`district-${element.DistrictID}`}
                            key={`location-${index}`}
                            className={`location-item${element.DistrictID === selected_district.DistrictID ? ' active' : ''}`}
                            onClick={() => handleOnclick_district(element)}
                        >
                            {element.DistrictName}
                        </li>
                    );
                })
            );
        }
        else {
            return (
                <li>There are no lists to be displayed!</li>
            );
        }
    }

    const ListOfWards = () => {
        if (wards.data !== null && wards.data !== undefined) {
            return (
                wards.data.map((element, index) => {
                    return (
                        <li
                            id={`ward-${element.WardCode}`}
                            key={`location-${index}`}
                            className={`location-item${element.WardCode === selected_ward.WardCode ? ' active' : ''}`}
                            onClick={() => handleOnclick_ward(element)}
                        >
                            {element.WardName}
                        </li>
                    );
                })
            );
        }
        else {
            return (
                <li>There are no lists to be displayed!</li>
            );
        }
    }

    const ListToBeDisplayed = () => {
        if (provinces !== null && districts === null && wards === null) {
            return ListOfProvinces();
        }
        else if (provinces !== null && districts !== null && wards === null) {
            return ListOfDistricts();
        }
        else if (provinces !== null && districts !== null && wards !== null) {
            return ListOfWards();
        }
        else {
            return (
                <li>There are no lists to be displayed!</li>
            );
        }
    }

    return (
        <div className='location-box-wrapper'>
            <div className='location-box'>
                <input type="checkbox" id="checkbox-for-LocationList" name="location"></input>
                <label htmlFor="checkbox-for-LocationList" className="location-btn">
                    <span className='location-btn__icon'>
                        <img className="location_img" src={icon__location}></img>
                    </span>
                    <span className="location-btn__title">{btnTitle}</span>
                </label>
                <label className="menu-overlay--dark" htmlFor="checkbox-for-LocationList"></label>
                <div className="location-list-wrapper">
                    <div className='location-list'>
                        <div className='location-list__title'>
                            <span className='title'>
                                <div className='top-heading'>{heading.topHeading}</div>
                                {heading.bottomHeading === '' ? <></> : <div className='bottom-heading'>{heading.bottomHeading}</div>}
                            </span>
                            {
                                selected_province !== -1 ? (
                                    <div className='goback-btn' onClick={() => handleOnclick_goBackBtn()}>
                                        <LeftOutlined className='icon' />
                                    </div>
                                ) : (
                                    <></>
                                )
                            }
                            <label htmlFor="checkbox-for-LocationList" className='close-btn'><CloseCircleOutlined className='icon' /></label>
                        </div>
                        <div className='location-list__lists'>
                            <ul className='locations'>
                                {ListToBeDisplayed()}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default LocationBox;