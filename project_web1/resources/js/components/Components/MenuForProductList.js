import React, { useContext, useEffect, useState } from 'react';

// Modules:
import { Dropdown, InputNumber, Menu } from 'antd';
import { Button } from 'antd';
import { DownOutlined, CheckOutlined, StarFilled } from '@ant-design/icons';
import swal from 'sweetalert';

// Context:
import { AuthContext } from '../Contexts/AuthContext';

// Redux:
import { useDispatch } from 'react-redux';
import {
    sortListByPrice_LowToHigh,
    sortListByPrice_HighToLow,
    getListByPriceRange,
    clearProducts,
    getProductsByCategory,
    getProducts,
    getProductsByRateRange,
    getListByRatingRange,
    sortListByRating_HighToLow,
    sortListByRating_LowToHigh
} from '../redux/reducers/products';

// CSS:
import '../assets/css/MenuForProductList.css';


function MenuForProductList(props) {
    // Context:
    const authCtx = useContext(AuthContext);
    const [isCheckedPriceRange, setIsCheckedPriceRange] = useState(false);
    const [isCheckedRatingRange, setIsCheckedRatingRange] = useState(false);

    // __________________________________________________
    // Redux:
    const dispatch = useDispatch();


    // __________________________________________________
    // Sorting Menu:
    const [sortingByPriceOption, setSortingByPriceOption] = useState(0);
    const [btnName, setBtnName] = useState('Sắp xếp');

    useEffect(() => {
        setSortingByPriceOption(1);
        dispatch(sortListByPrice_LowToHigh());
        setBtnName('Giá tăng dần');
    }, []);

    const handleMenuClick = (e) => {
        if (e.key === '1' && sortingByPriceOption !== 1) {
            setSortingByPriceOption(1);
            dispatch(sortListByPrice_LowToHigh());
            setBtnName('Giá tăng dần');
        }
        else if (e.key === '2' && sortingByPriceOption !== 2) {
            setSortingByPriceOption(2);
            dispatch(sortListByPrice_HighToLow());
            setBtnName('Giá giảm dần');
        }
        else if (e.key === '3' && sortingByPriceOption !== 3) {
            setSortingByPriceOption(3);
            dispatch(sortListByRating_LowToHigh());
            setBtnName('Số sao tăng dần');
        }
        else if (e.key === '4' && sortingByPriceOption !== 4) {
            setSortingByPriceOption(4);
            dispatch(sortListByRating_HighToLow());
            setBtnName('Số sao giảm dần');
        }
    }


    // __________________________________________________
    // Price Range Menu:
    const [priceRangeBtnTitle, setPriceRangeBtnTitle] = useState('Mặc định');
    const [priceFrom, setPriceFrom] = useState(0);
    const [priceTo, setPriceTo] = useState(100000000);

    const handlePriceRangeBtnClick = () => {
        if (priceFrom !== 0 || priceTo !== 100000000) {
            if (priceFrom <= priceTo) {
                const payload = {
                    from: priceFrom,
                    to: priceTo
                }
                dispatch(getListByPriceRange(payload));
                setPriceRangeBtnTitle(`${priceFrom.toLocaleString()}₫ - ${priceTo.toLocaleString()}₫`);
                setIsCheckedPriceRange(!isCheckedPriceRange);
            }
            else {
                swal({
                    title: 'Invalid action!',
                    text: 'Phạm vi giá không hợp lệ',
                    icon: "error",
                    button: "Ok!",
                });
            }
        }
    }

    const handleDefaultPriceRangeBtnClick = () => {
        if (priceFrom !== 0 || priceTo !== 100000000) {
            setPriceFrom(0);
            setPriceTo(100000000);
            if (props.categoryID === 'all') {
                dispatch(clearProducts());
                dispatch(getProducts(authCtx.token));
            }
            else if (isNaN(props.categoryID) === false) {
                const payload = {
                    key: props.categoryID,
                    token: authCtx.token
                }
                dispatch(clearProducts());
                dispatch(getProductsByCategory(payload));
                setPriceRangeBtnTitle('Mặc định');
            }
        }
    }

    const handlePriceFromChange = (value) => {
        setPriceFrom(value);
    }

    const handlePriceToChange = (value) => {
        setPriceTo(value);
    }


    // __________________________________________________
    // Component:
    // price
    const menu = (
        <Menu onClick={(e) => handleMenuClick(e)}>
            <Menu.Item key="1" icon={sortingByPriceOption === 1 ? <CheckOutlined /> : <></>}>
                Giá tăng dần
            </Menu.Item>
            <Menu.Item key="2" icon={sortingByPriceOption === 2 ? <CheckOutlined /> : <></>}>
                Giá giảm dần
            </Menu.Item>
            <Menu.Item key="3" icon={sortingByPriceOption === 3 ? <CheckOutlined /> : <></>}>
                Sao tăng dần
            </Menu.Item>
            <Menu.Item key="4" icon={sortingByPriceOption === 4 ? <CheckOutlined /> : <></>}>
                Sao giảm dần
            </Menu.Item>
        </Menu>
    );

    //rating

    const [ratingRangeBtnTitle, setRatingRangeBtnTitle] = useState('Mặc định');
    const [ratingFrom, setRatingFrom] = useState(0);
    const [ratingTo, setRatingTo] = useState(5);

    const handleResetRatingValues = () => {
        if (ratingFrom != 0 || ratingTo != 5) {
            setRatingFrom(0);
            setRatingTo(5);
            // Check all category
            if (props.categoryID === 'all') {
                dispatch(clearProducts());
                dispatch(getProducts(authCtx.token));
            }
            // Check category id is a number
            else if (isNaN(props.categoryID) === false) {
                const payload = {
                    key: props.categoryID,
                    token: authCtx.token
                }
                dispatch(clearProducts());
                dispatch(getProductsByCategory(payload));
                setPriceRangeBtnTitle('Mặc định');
            }

        }
    }

    const handleSubmitRatingValues = () => {
        // Checking isn't default values
        if (priceFrom !== 0 || priceTo !== 5) {
            if (priceFrom <= priceTo) {
                if (props.categoryID === 'all') {
                    const payload = {
                        params: {
                            start: ratingFrom,
                            end: ratingTo,
                        },
                        token: authCtx.token,
                    }
                    dispatch(getProductsByRateRange(payload));
                }
                else {
                    const payload = {
                        from: ratingFrom,
                        to: ratingTo,
                    }
                    dispatch(getListByRatingRange(payload));
                }
                setRatingRangeBtnTitle(`${ratingFrom.toLocaleString()} - ${ratingTo.toLocaleString()}`);
                setIsCheckedRatingRange(!isCheckedRatingRange);
            }
            else {
                swal({
                    title: 'Invalid action!',
                    text: 'Phạm vi yêu thích không hợp lệ',
                    icon: "error",
                    button: "Ok!",
                });
            }
        }
    }

    const handleRatingFromChange = (value) => {
        setRatingFrom(value);
    }

    const handleRatingToChange = (value) => {
        setRatingTo(value);
    }

    const handleCheckedPriceChange = () => {
        setIsCheckedPriceRange(!isCheckedPriceRange)
    }
    const handleCheckedRatingChange = () => {
        setIsCheckedRatingRange(!isCheckedRatingRange)
    }




    return (
        <>
            {/* Controls: */}
            <div className='controls-wrapper'>
                <div className='controls'>
                    <div className='range-options-wrapper'>
                        <div className='priceRange-options'>
                            <div className='priceRange-options--left'>
                                <div className='title'>Phạm vi giá:</div>
                            </div>
                            <div className='priceRange-options--right'>
                                <label className="current-option" htmlFor="checkbox-for-priceRangeMenu">{priceRangeBtnTitle} <DownOutlined className='label-icon' /></label>
                                <input type="checkbox" onChange={handleCheckedPriceChange} checked={isCheckedPriceRange} name="" id="checkbox-for-priceRangeMenu"></input>
                                <label className="menu-overlay" htmlFor="checkbox-for-priceRangeMenu"></label>
                                <div className='priceRange-menu'>
                                    <div className='priceRange--from'>
                                        <span className='label'>Từ:</span>
                                        <InputNumber className='input-price' min={0} max={100000000} step={1000} value={priceFrom} defaultValue={0} onChange={handlePriceFromChange} />
                                        <span className='unit-of-price'>₫</span>
                                    </div>
                                    <div className='priceRange--to'>
                                        <span className='label'>đến:</span>
                                        <InputNumber className='input-price' min={0} max={100000000} step={1000} value={priceTo} defaultValue={100000000} onChange={handlePriceToChange} />
                                        <span className='unit-of-price'>₫</span>
                                    </div>
                                    <div className='priceRange-menu__btns'>
                                        <Button
                                            className='priceRange-menu__btn'
                                            type="primary"
                                            onClick={(e) => handleDefaultPriceRangeBtnClick(e)}>Mặc định</Button>
                                        <Button
                                            className='priceRange-menu__btn submit-btn'
                                            type="primary"
                                            size="middle"
                                            onClick={(e) => handlePriceRangeBtnClick(e)}>OK</Button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="ratingRange-options">
                            <div className="ratingRange-options--left">
                                <div className="title">Phạm vi điểm đánh giá:</div>
                            </div>
                            <div className="ratingRange-options--right">
                                <label htmlFor="checkbox-for-ratingRangeMenu" className="current-option">
                                    {ratingRangeBtnTitle}
                                    <DownOutlined className="label-icon" />
                                </label>
                                <input type="checkbox" checked={isCheckedRatingRange} onChange={handleCheckedRatingChange}  id="checkbox-for-ratingRangeMenu" />
                                <label className="menu-overlay" htmlFor="checkbox-for-ratingRangeMenu" />
                                <div className="ratingRange-menu">
                                    <div className="ratingRange--from">
                                        <span className="label">Từ:</span>
                                        <InputNumber
                                            className="input-rating"
                                            min="0"
                                            max="5"
                                            value={ratingFrom}
                                            onChange={handleRatingFromChange}
                                        />
                                        <span><StarFilled className='star-icon' style={{ color: '#fadb14' }} /></span>
                                    </div>
                                    <div className="ratingRange--to">
                                        <span className="label">đến:</span>
                                        <InputNumber
                                            className="input-rating"
                                            min="0"
                                            max="5"
                                            value={ratingTo}
                                            onChange={handleRatingToChange}
                                        />
                                        <span><StarFilled className='star-icon' style={{ color: '#fadb14' }} /></span>
                                    </div>
                                    <div className="ratingRange-menu__btns">
                                        <Button
                                            className="ratingRange-menu__btn"
                                            type="primary"
                                            onClick={(e) => handleResetRatingValues(e)}>Mặc định</Button>
                                        <Button
                                            className="ratingRange-menu__btn submit-btn"
                                            type="primary"
                                            onClick={(e) => handleSubmitRatingValues(e)}>OK</Button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className='sort-options-wrapper'>
                        <div className='sort-options'>
                            <span className='title'>Sắp xếp: </span>
                            <Dropdown overlay={menu}>
                                <Button>
                                    {btnName} <DownOutlined />
                                </Button>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default MenuForProductList;