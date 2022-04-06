import React from 'react'

export default function useRadioChange() {
    const [value, setValue] = React.useState(1);

    const onChange = e => {
        console.log('radio checked', e.target.value);
        setValue(e.target.value);
  };
    return [value, onChange];
}
