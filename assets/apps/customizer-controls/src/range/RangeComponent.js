/* jshint esversion: 6 */

import PropTypes from 'prop-types';
import Range from './Range';
import { useState, useEffect } from '@wordpress/element';

const RangeComponent = ({ control }) => {
	useEffect(() => {
		document.addEventListener('neve-changed-customizer-value', (e) => {
			if (!e.detail) return false;
			if (e.detail.id !== control.id) return false;
			updateValues(e.detail.value);
		});
	}, []);

	const [value, setValue] = useState(control.setting.get());
	const defaults = { min: 0, max: 100, defaultVal: 15, step: 1 };
	const controlProps = {
		...defaults,
		...(control.params.input_attrs || {}),
	};
	const { label } = control.params;
	const { defaultVal, min, max, step } = controlProps;
	const noticeText = control.paramsT ? control.params.notice_text : '';
	const updateValues = (newVal) => {
		setValue(newVal);
		control.setting.set(newVal);
	};

	return (
		<div>
			<Range
				value={value}
				label={label}
				defaultVal={defaultVal}
				onChange={updateValues}
				step={step}
				min={min}
				max={max}
			/>
			{noticeText && <p>{noticeText}</p>}
		</div>
	);
};

RangeComponent.propTypes = {
	control: PropTypes.object.isRequired,
};

export default RangeComponent;
