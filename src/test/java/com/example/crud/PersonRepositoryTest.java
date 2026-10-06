package com.example.crud;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class PersonRepositoryTest {

    @Test
    void shouldCreateReadUpdateAndDeletePerson() {
        PersonRepository repository = new PersonRepository();

        repository.add(new Person(1, "Alice", "alice@example.com"));
        assertEquals(1, repository.findAll().size());
        assertTrue(repository.findById(1).isPresent());

        assertTrue(repository.update(1, "Alice Smith", "alice.smith@example.com"));
        assertEquals("Alice Smith", repository.findById(1).orElseThrow().getName());

        assertTrue(repository.delete(1));
        assertTrue(repository.findAll().isEmpty());
    }

    @Test
    void shouldRejectDuplicateIds() {
        PersonRepository repository = new PersonRepository();
        repository.add(new Person(1, "Alice", "alice@example.com"));

        assertThrows(IllegalArgumentException.class,
                () -> repository.add(new Person(1, "Bob", "bob@example.com")));
    }
}
