import React from "react";
import "../App.css";
import { useState } from "react";
import "bootstrap/dist/css/bootstrap.css";

function TagInput(props) {
  const { tags, setTags } = props;
  const [value, setValue] = useState("");

  function handleKeyDown(e) {
    if (e.key !== "Enter") return;
    const value = e.target.value;
    if (!value.trim()) return;
    setTags([...tags, value]);
    setValue("");
  }

  function removeTag(index) {
    setTags(tags.filter((el, i) => i !== index));
  }

  return (
    <div className="tags-input-container mb-3">
      {tags.map((tag, index) => (
        <div className="tag-item" key={index}>
          <span className="text">{tag}</span>
          <span className="close" onClick={() => removeTag(index)}>
            &times;
          </span>
        </div>
      ))}
      <input
        style={{ fontSize: "20px" }}
        onKeyDown={handleKeyDown}
        type="text"
        className="tags-input"
        placeholder="Enter tags separated by Enter key"
        required
        value={value}
        onChange={(e) => setValue(e.target.value)}
      />
      <div>
        {tags.length === 0 && (
          <div style={{ color: "red" }}>Please enter at least one tag.</div>
        )}
      </div>
    </div>
  );
  
      }

export default TagInput;
