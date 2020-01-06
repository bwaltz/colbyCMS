import React, { Component } from "react";
import "../style.scss";

import CheckboxTree from "react-checkbox-tree";
import "react-checkbox-tree/lib/react-checkbox-tree.css";

export default class Categories extends Component {
    constructor(props) {
        super(props);
        this.state = {
            categories: [],
            checked: [],
            expanded: []
        };
    }

    componentDidMount() {
        // this.getPages();
    }

    render() {
        console.log(this.state);

        const nodes = [
            {
                value: "academics",
                label: "Academics",
                children: [
                    { value: "english", label: "English" },
                    { value: "biology", label: "Biology" },
                    {
                        value: "computer science",
                        label: "Computer Science",
                        children: [{ value: "ai", label: "AI" }]
                    }
                ]
            },
            {
                value: "athletics",
                label: "Athletics",
                children: [
                    { value: "swimming", label: "Swimming" },
                    { value: "golf", label: "Golf" },
                    { value: "basketball", label: "Basketball" }
                ]
            }
        ];

        return (
            <div
                style={{
                    boxShadow: "0 1px 1px rgba(0,0,0,.04)",
                    border: "1px solid #e5e5e5",
                    background: "#fff",
                    marginBottom: "20px"
                }}
            >
                <div
                    style={{
                        borderBottom: "1px solid #eee",
                        padding: "10px",
                        fontSize: " 1.5em",
                        display: "flex",
                        justifyContent: "space-between"
                    }}
                >
                    <div>Categories</div>
                </div>
                <div style={{ padding: "10px" }}>
                    <CheckboxTree
                        nodes={nodes}
                        checked={this.state.checked}
                        expanded={this.state.expanded}
                        onCheck={checked => this.setState({ checked })}
                        onExpand={expanded => this.setState({ expanded })}
                        icons={{
                            check: <span className="rct-icon rct-icon-check" />,
                            uncheck: (
                                <span className="rct-icon rct-icon-uncheck" />
                            ),
                            halfCheck: (
                                <span className="rct-icon rct-icon-half-check" />
                            ),
                            expandClose: (
                                <span className="rct-icon rct-icon-expand-close" />
                            ),
                            expandOpen: (
                                <span className="rct-icon rct-icon-expand-open" />
                            ),
                            expandAll: (
                                <span className="rct-icon rct-icon-expand-all" />
                            ),
                            collapseAll: (
                                <span className="rct-icon rct-icon-collapse-all" />
                            ),
                            parentClose: (
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    className="feather feather-tag"
                                >
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                            ),
                            parentOpen: (
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    className="feather feather-tag"
                                >
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                            ),
                            leaf: (
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    className="feather feather-tag"
                                >
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                            )
                        }}
                        noCascade
                    />
                </div>
            </div>
        );
    }
}
