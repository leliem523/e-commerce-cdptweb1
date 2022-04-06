import React, { useContext, useEffect, useRef, useState } from 'react';
import { Input, AutoComplete } from 'antd';
import { DoubleRightOutlined } from '@ant-design/icons';

import { AuthContext } from '../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import { autocompleteSearch } from '../redux/reducers/suggestions';

// Components:
const { Search } = Input;

const searchResult = (productResultList) => {
    return new Array(productResultList.length - 1)
        .join('.')
        .split('.')
        .map((_, idx) => {
            return {
                key: `${productResultList[idx].id}`,
                value: `${productResultList[idx].name}`,
                label: (
                    <div className='suggestion-content-wrapper'>
                        <div className='suggestion-content'>
                            <a
                                href={`/product/${productResultList[idx].id}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className='suggestion-content__icon'
                            >
                                <DoubleRightOutlined />
                            </a>
                            <div className='suggestion-content__key'>{productResultList[idx].name}</div>
                        </div>
                    </div>
                ),
            };
        });
}

const SearchBox = (props) => {
    const authCtx = useContext(AuthContext);

    const { searchSuggestions } = useSelector(state => state.suggestions)
    const dispatch = useDispatch()

    const [options, setOptions] = useState([]);
    const timerID = useRef(-1);

    const handleSearch = (value) => {
        clearTimeout(timerID.current);
        timerID.current = setTimeout(() => {
            value = value.replace(/^\s+|\s+$/g, "");
            const payload = {
                key: value,
                token: authCtx.token,
            }
            if (value.length !== 0) {
                dispatch(autocompleteSearch(payload))
            }
        }, 1000);
        // setOptions(searchSuggestions.length !== 0 ? searchResult(searchSuggestions) : []);
    };


    const onSelect = (value) => {
        // console.log('onSelect', value);
    };

    useEffect(() => {
        setOptions(searchSuggestions.length !== 0 ? searchResult(searchSuggestions) : []);
    }, [searchSuggestions]);

    return (
        <div className='search-box-wrapper'>
            <AutoComplete
                dropdownMatchSelectWidth={252}
                className='autoComplete-search-box'
                options={options}
                onSelect={onSelect}
                onSearch={handleSearch}
            >
                <Search placeholder="Search something"
                    allowClear
                    onSearch={props.onSearch}
                    enterButton
                    enterButton="Search"
                    className="search-box"
                />
            </AutoComplete>
        </div>
    );
};

export default SearchBox