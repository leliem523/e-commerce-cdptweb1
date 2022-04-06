import { Result, Button } from 'antd';
import React from 'react';
import { useHistory } from 'react-router-dom/cjs/react-router-dom.min';
import LayoutWrapper from '../Components/LayoutWrapper';

const NotfoundPage = () => {
    const history = useHistory();
    const handleBackHomeClick = () => {
        history.push("/");
    }

    // Page content:
    const mainContent = () => {
        return (
            <Result
                status="404"
                title="404"
                subTitle="Sorry, the page you visited does not exist."
                extra={<Button type="primary" onClick={handleBackHomeClick} >Back Home</Button>}
            />
        );
    }

    return (
        <>
            <div className="404-page">
                <LayoutWrapper mainContent={mainContent}></LayoutWrapper>
            </div>
        </>
    );
}

export default NotfoundPage;
