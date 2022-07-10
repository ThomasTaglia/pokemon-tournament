import React from 'react';
import TableCell from "@mui/material/TableCell";
import TableRow from "@mui/material/TableRow";
import DeleteIcon from '@mui/icons-material/Delete';
import Button from "@mui/material/Button";
import {toast} from "react-toastify";

function Pokemon({pokemon}) {

    function handleDeletePokemonSubmit(event) {
        try {
            fetch(process.env.REACT_APP_BACK_END_API + '/pokemon/' + pokemon.id, {
                method: "DELETE",
            })
                .then(res => res.json())
                .then(data => {
                    toast.success(data.message);
                });
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    return (
        <TableRow
            key={pokemon.id}
            sx={{'&:last-child td, &:last-child th': {border: 0}}}
        >
            <TableCell component="th" scope="row">
                {pokemon.name}
            </TableCell>
            <TableCell align="right">{pokemon.baseExperience}</TableCell>
            <TableCell align="right"><img src={pokemon.img} alt='pokemon'/></TableCell>
            <TableCell align="right">{pokemon.types.join(', ')}</TableCell>
            <TableCell align="right">
                <form onSubmit={handleDeletePokemonSubmit} style={{padding: "10px"}}>
                    <Button variant="contained" type='submit'
                            color='error'><DeleteIcon/></Button>
                </form>
            </TableCell>
        </TableRow>
    );
}

export default Pokemon;