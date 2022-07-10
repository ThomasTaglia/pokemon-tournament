import React from 'react';
import Tabs from "@mui/material/Tabs";
import LinkTab from "@mui/material/Link";
import { Link } from "react-router-dom";
import Toolbar from "@mui/material/Toolbar";
import IconButton from "@mui/material/IconButton";
import MenuIcon from "@mui/icons-material/Menu";
import Typography from "@mui/material/Typography";
import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import AppBar from "@mui/material/AppBar";
import Divider from "@mui/material/Divider";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemText from "@mui/material/ListItemText";


function Header({ navItems }) {

    return (
        <AppBar component="nav">
            <Toolbar>
                <IconButton
                    color="inherit"
                    aria-label="open drawer"
                    edge="start"
                    sx={{ mr: 2, display: { sm: 'none' } }}
                >
                    <MenuIcon />
                </IconButton>
                <Typography
                    variant="h6"
                    component="div"
                    sx={{ flexGrow: 1, display: { xs: 'none', sm: 'block' } }}
                >
                    Pokemon Tournament
                </Typography>
                <Box sx={{ display: { xs: 'none', sm: 'block' } }}>
                    {
                        navItems.map((item) => (
                            <Link
                                to={item.link}
                                style={{
                                    paddingLeft: "5px",
                                    textColor: "white",
                                }}
                                key={item.title}
                            >
                                {item.title}
                            </Link>
                        ))
                    }
                </Box>
            </Toolbar>
        </AppBar>
    );
}

export default Header;